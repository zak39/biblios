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

Configurer sa base de données :

```ini
# .env.local
DATABASE_URL="mysql://user:password@127.0.0.1:3306/biblios?serverVersion=8.0&charset=utf8"
```

> Ici c'est c'est un exemple avec une base MySql et le fichier `.env.local` ne sera pas pris en compte par git.

Création de la database et des tables :

```bash
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
```

Nourrir la database de données à partir des fixtures :

```bash
symfony console doctrine:fixtures:load
```

Et enfin, lancer le serveur :

```bash
symfony server:start -d
```

### Shortcuts

Ce projet utilise Castor comme Task Runner.

Voici la commande pour l'installer :

```bash
curl "https://castor.jolicode.com/install" | bash
```

> Prioriser la documentation officielle : https://castor.jolicode.com/getting-started/installation/ .

On peut connaître les commandes de base en exécutant la commande `castor` ou voir la partie Getting Started en faisant `castor getting-started`.

## Time line

- le 31 juillet 2024 : Utilisation de [Twig Components](https://ux.symfony.com/twig-component) - regardez la branche `init-twig-components`.
- le 28 juillet 2024 : Utilisation de [Symfony UX Icons](https://ux.symfony.com/icons) - regardez la branche `ajout-des-icons-components`.
- le 26 juillet 2024 : Utilisation de Castor by @jolicode - regardez la branche `init-le-task-runner-castor`.
- le 29 juin 2024 : Fin du cours d'OpenClassrooms dont le code est préservé à partir de cette date dans la branche `code-du-cours-symfony-7-d-openclassroom`.