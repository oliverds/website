<?php

namespace Deployer;

set('php_version', function () {
    return ask(' What PHP version to install? ', '8.1', ['8.0', '8.1']);
});

desc('Installs PHP packages');
task('provision:php-extra', function () {
    $version = get('php_version');
    info("Installing PHP $version");
    $packages = [
        // "php$version-memcached",
        // "php$version-msgpack",
        // "php$version-igbinary",
        // "php$version-gmp",
        "php$version-swoole",
    ];
    run('apt-get install -y ' . implode(' ', $packages), ['env' => ['DEBIAN_FRONTEND' => 'noninteractive']]);
})
    ->verbose()
    ->limit(1);
