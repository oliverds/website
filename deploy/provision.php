<?php

namespace Deployer;

use function Deployer\Support\parse_home_dir;

function password_generate()
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';

  return substr(str_shuffle($data), 0, 20);
}

set('hostname', function () {
    return ask(' Hostname: ');
});

set('ip_address', function () {
    return ask(' IP Address: ');
});

desc('Provision Server');
task('provision', [
    'provision:setup',
    'provision:caddy',
]);

// Specify which key to copy to server.
// Set to `false` to disable copy of key.
set('ssh_copy_id', '~/.ssh/id_rsa.pub');

// Specify sudo and database passwords.
set('sudo_password', password_generate());
set('database_password', password_generate());

desc('Inital setup');
task('provision:setup', function () {
    run('touch /root/forge.sh');
    run('echo "$KEY" >> /root/forge.sh', ['env' => ['KEY' => file_get_contents(__DIR__ . '/forge.sh')]]);
    run('sed -i "s/::hostname::/' . get('hostname'). '/g" /root/forge.sh');
    run('sed -i "s/::ip_address::/' . get('ip_address'). '/g" /root/forge.sh');
    run('sed -i "s/::sudo_password::/' . get('sudo_password'). '/g" /root/forge.sh');
    run('sed -i "s/::database_password::/' . get('database_password'). '/g" /root/forge.sh');
    run('bash forge.sh', ['timeout' => null, "real_time_output" => true]);

    if (!empty(get('ssh_copy_id'))) {
        $file = parse_home_dir(get('ssh_copy_id'));
        if (!file_exists($file)) {
            info('Configure path to your public key.');
            writeln("");
            writeln("    set(<info>'ssh_copy_id'</info>, <info>'~/.ssh/id_rsa.pub'</info>);");
            writeln("");
            $file = ask(' Specify path to your public ssh key: ', '~/.ssh/id_rsa.pub');
        }
        run('echo "$KEY" >> /root/.ssh/authorized_keys', ['env' => ['KEY' => file_get_contents(parse_home_dir($file))]]);
    }
    run('cp /root/.ssh/authorized_keys /home/forge/.ssh/authorized_keys');

    writeln('Sudo Password: '. get('sudo_password'));
    writeln('Database Password: '. get('database_password'));
})->oncePerNode()->verbose();

desc('Use Caddy');
task('provision:caddy', function () {
    // Stop and disable NGINX
    run('systemctl stop nginx');
    run('systemctl disable nginx');

    # Install Caddy
    run('apt install -y debian-keyring debian-archive-keyring apt-transport-https');
    run("curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | tee /etc/apt/trusted.gpg.d/caddy-stable.asc");
    run("curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | tee /etc/apt/sources.list.d/caddy-stable.list");
    run('apt-get update -y', ['no_throw' => true]);
    run('apt-get install -y caddy');
})->oncePerNode()->verbose();

desc('Enable opcache');
task('provision:opcache', function () {
    run('sed -i "s/;opcache.enable=1/opcache.enable = 1/" /etc/php/8.1/fpm/php.ini');
    run('sed -i "s/;opcache.memory_consumption=128/opcache.memory_consumption = 512/" /etc/php/8.1/fpm/php.ini');
    run('sed -i "s/;opcache.interned_strings_buffer=8/opcache.interned_strings_buffer = 64/" /etc/php/8.1/fpm/php.ini');
    run('sed -i "s/;opcache.max_accelerated_files=10000/opcache.max_accelerated_files = 30000/" /etc/php/8.1/fpm/php.ini');
    run('sed -i "s/;opcache.validate_timestamps=1/opcache.validate_timestamps = 0/" /etc/php/8.1/fpm/php.ini');
    run('sed -i "s/;opcache.save_comments=1/opcache.save_comments = 1/" /etc/php/8.1/fpm/php.ini');
})->oncePerNode()->verbose();

desc('Add SSH key');
task('provision:ssh:key', function () {
    $key = ask(' SSH key: ');

    run('echo "$KEY" >> /root/.ssh/authorized_keys', ['env' => ['KEY' => $key]]);
    run('cp /root/.ssh/authorized_keys /home/forge/.ssh/authorized_keys');
})->oncePerNode()->verbose();

desc('Shows nginx error logs');
task('logs:nginx:error', function () {
    run('sudo tail -f /var/log/nginx/error.log');
})->verbose();

desc('Shows nginx access logs');
task('logs:nginx:access', function () {
    run('sudo tail -f /var/log/nginx/access.log');
})->verbose();

desc('Shows php logs');
task('logs:php', function () {
    run('sudo tail -f /var/log/php8.1-fpm.log');
})->verbose();

desc('Shows php logs');
task('logs:php', function () {
    run('sudo tail -f /var/log/php8.1-fpm.log');
})->verbose();

desc('Shows mysql logs');
task('logs:mysql', function () {
    run('sudo tail -f /var/log/mysql/error.log');
})->verbose();

desc('Shows redis logs');
task('logs:redis', function () {
    run('sudo tail -f /var/log/redis/redis-server.log');
})->verbose();

desc('Shows ssh auth logs');
task('logs:ssh:auth', function () {
    run('sudo tail -f /var/log/auth.log');
})->verbose();
