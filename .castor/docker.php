<?php

namespace docker;

use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\io;
use function Castor\run;

#[AsTask(description: 'Up services docker', aliases: ['d:u'])]
function up(bool $quietly = false, ?array $services = null) {
    $commands = ['docker', 'compose', 'up'];

    if (!is_null($services)) {
        $commands = array_merge($commands, $services);
    }

    $commands[] = '-d';
    
    $dockerUp = run($commands, context: context()->withQuiet($quietly));

    if (!$dockerUp->isSuccessful()) {
        io()->error('Impossible to up services with docker');
        return;
    }

    io()->info('Waitting 30s before to continue');
    sleep(30);

    io()->info('All services are up');
}

#[AsTask(description: 'Down services docker', aliases: ['d:d'])]
function down(bool $volumes = false, bool $quietly = false) {

    $dockerCommands = ['docker', 'compose', 'down'];

    if ($volumes) {
        $dockerCommands[] = '-v';
    }

    $dockerDown = run($dockerCommands, context: context()->withQuiet($quietly));

    if (!$dockerDown->isSuccessful()) {
        io()->error('Impossible to down services with docker');
        return;
    }

    io()->info('All services are down');
}

#[AsTask(description: 'Get the status of docker compose', aliases: ['d:status'])]
function status() {
    run('docker compose ps');
}