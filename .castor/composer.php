<?php

namespace composer;

use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\io;
use function Castor\run;

#[AsTask(description: 'Install dependencies with composer', aliases: ['install', 'c:i'])]
function install(bool $prod = false, ?bool $quietly = null) {
    $commands = ['composer', 'install'];
    
    if ($prod) {
        $commands[] = '--no-dev';
    }
    
    $res = run($commands, context: context()->withQuiet($quietly ?? false));

    if (!$res->isSuccessful()) {
        io()->error('Impossible to install dependencies.');
    }
}

#[AsTask(description: 'Remove the vendor folder and composer.lock file', aliases: ['c:c'])]
function clean(?bool $quietly = null) {
    
    $res = run('rm -fr vendor composer.lock', context: context()->withQuiet($quietly ?? false));

    if (!$res->isSuccessful()) {
        io()->error('Impossible to remove the vendor folder and composer.lock file.');
    }
}
