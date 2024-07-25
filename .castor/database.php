<?php

namespace database;

use Castor\Attribute\AsTask;

use function Castor\io;
use function Castor\run;

#[AsTask(description: 'Init the database part', aliases: ['db:init'])]
function init(bool $quietly = false): void
{    
    $dbCreated = run('symfony console doctrine:database:create', quiet: $quietly);

    if (!$dbCreated->isSuccessful()) {
        io()->error('Impossible to create the database');
        return;
    }

    $dbMigrated = run('symfony console doctrine:migrations:migrate -n', quiet: $quietly);

    if (!$dbMigrated->isSuccessful()) {
        io()->error('Impossible to migrate the database');
        return;
    }

    $fixturesLoaded = run('symfony console doctrine:fixtures:load -n', quiet: $quietly);

    if (!$fixturesLoaded->isSuccessful()) {
        io()->error('Impossible to apply fixtures');
        return;
    }

    io()->success('The database is ready');
}

#[AsTask(description: 'Drop the database with force', aliases: ['db:drop'])]
function drop(): void
{
    $result = run('symfony console doctrine:database:drop --force');

    if($result->isSuccessful()) {
        io()->success('The database is dropped');
        return;
    }

    io()->error('Impossible to drop the database');
}