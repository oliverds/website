<?php

namespace Deployer;

desc('Provision Redis');
task('provision:redis', function () {
    run('apt-get install -y redis-server', ['env' => ['DEBIAN_FRONTEND' => 'noninteractive'], 'timeout' => 900]);
    run("sed -i 's/bind 127.0.0.1/bind 0.0.0.0/' /etc/redis/redis.conf");
    run('service redis-server restart');
    run('systemctl enable redis-server');
})
    ->limit(1);
