<?php

namespace symfony;

use Castor\Attribute\AsTask;

use function Castor\io;
use function Castor\run;

#[AsTask(description: 'echo')]
function hello(): void
{
    io()->text('Hello Symfony');
}

#[AsTask(description: 'Run the server in background', aliases: ['sf:start'])]
function start(): void
{
    $result = run('symfony server:start -d');

    if(!$result->isSuccessful()) {
        io()->error('Impossible to run the server');
        return;
    }
}

#[AsTask(description: 'Run the server in background', aliases: ['sf:stop'])]
function stop(): void
{
    $result = run('symfony server:stop');

    if(!$result->isSuccessful()) {
        io()->error('Impossible to stop the server');
        return;
    }

    io()->success('The server is stopped');
}
