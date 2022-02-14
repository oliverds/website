<?php

namespace Deployer;

desc('Provision Supervisor');
task('provision:supervisor', function () {
    run('apt-get install -y supervisor', ['env' => ['DEBIAN_FRONTEND' => 'noninteractive'], 'timeout' => 900]);
    run('echo "deployer ALL=NOPASSWD: /usr/bin/supervisorctl *" >> /etc/sudoers.d/supervisor');
    run('systemctl enable supervisor.service');
    run('service supervisor start');
})
    ->limit(1);
