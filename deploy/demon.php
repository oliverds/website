<?php

namespace Deployer;

set('command', function () {
    return ask(' Command: ');
});

set('directory', function () {
    return ask(' Directory: ', 'public');
});

set('user', function () {
    return ask(' User: ', 'deployer');
});

set('number_of_processes', function () {
    return ask(' Number of Processes: ', '1');
});

set('start_seconds', function () {
    return ask(' Start Seconds: ', '1');
});

set('stop_seconds', function () {
    return ask(' Stop Seconds: ', '10');
});

set('stop_signal', function () {
    return ask(' Stop Signal: ', 'SIGTERM');
});
