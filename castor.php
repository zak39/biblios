<?php

use Castor\Attribute\AsTask;

use function Castor\import;
use function Castor\io;

import(__DIR__ . '/.castor/symfony.php');
import(__DIR__ . '/.castor/database.php');

#[AsTask(description: 'Getting Started to begin with commands')]
function gettingStarted(): void {
    io()->title('Getting started for Biblios');
    io()->text('It\'s a project to learn Symfony 7 from by <href=https://openclassrooms.com/fr/courses/8264046-construisez-un-site-web-a-laide-du-framework-symfony-7>OpenClassrooms</>.');
    io()->text('To start this project, follow these steps.');

    io()->section('Database');
    io()->text('You must create the database, create tables and fill them:');
    io()->newLine();
    io()->text('$ castor database:init');
    io()->newLine(2);
    io()->note('If you have a existing database, you could drop the database with the "castor database:drop" command');
    io()->newLine(2);

    io()->section('Server');
    io()->text('After init your database, go to start the server :');
    io()->newLine();
    io()->text('$ castor symfony:start');
    io()->newLine();
    io()->text('You could stop the server with this command :');
    io()->newLine();
    io()->text('$ castor symfony:stop');
    io()->newLine(2);
}
