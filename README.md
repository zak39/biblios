# Biblios

Biblios est le projet fil rouge du cours d'OpenClassrooms sur [Symfony 7](https://openclassrooms.com/fr/courses/8264046-construisez-un-site-web-a-laide-du-framework-symfony-7).

J'ai pu [terminer le cours](#time-line) avec succès, je pourrais utiliser ce repo comme base.

## Requirements

- [symfony cli](https://symfony.com/download)
- Symfony 7.X
- PHP 8.3
- [composer](https://getcomposer.org/download/)

## Setup

Installation des dépendances :

```bash
composer i
```

Création de la database et des tables :

```bash
symfony console doctrine:database:create
symfony console doctrine:migrations:execute
```

Nourrir la database de données à partir des fixtures :

```bash
php bin/console doctrine:fixtures:load
```

Et enfin, lancer le serveur :

```bash
symfony server:start -d
```

## Time line

- le 29 juin 2024 : Fin du cours d'OpenClassrooms dont le code est préservé à partir de cette date dans la branche `code-du-cours-symfony-7-d-openclassroom`.