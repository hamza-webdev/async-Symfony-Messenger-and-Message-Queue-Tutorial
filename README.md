async-Symfony Messenger and Message Queue Tutorial
-------------

Il s'agit d'une série sur la création et la gestion de tâches d'arrière-plan asynchrones dans Symfony à l'aide du composant Messenger. Dans la partie 1, nous commencerons par examiner le problème que les files d'attente de messages asynchrones peuvent résoudre pour nous et nous verrons également ce que nous allons construire.

Messenger fournit un bus de messages avec la possibilité d'envoyer des messages, puis de les gérer immédiatement dans votre application ou de les envoyer via des transports (par exemple, des files d'attente) pour qu'ils soient traités ultérieurement.

Requirements
------------
- [PHP 8.0 or higher](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
<!-- - [Docker](https://www.docker.com/) -->

Usage
-----
Install all dependencies via `composer`:

```bash
$ composer install
```
Run the project:

```bash
$ php -S localhost:8000 -t public/
```
or

```bash
$ symfony server:start -d
```

Run Mailer

```bash
 symfony open:local:webmail
````

Consume messanger

````
symfony console messenger:consume async -vv

````

Message Failures and Retries
-----
forcer une error dans le fichier OrderSavedHandler pour bloquer la consomation des message
// Attemt to retrieve an order from MongoDB
throw new \RuntimeException('ORDER COULD Not BE FOUND)
### Result
```
symfony console messenger:consume async -vv`
 CRITICAL  [messenger] Error thrown while handling message App\Message\Event\OrderSavedEvent. Removing from transport after 3 retries. Error: "Handling "App\Message\Event\OrderSavedEvent" failed: ORDER COULD NOT BE FOUND bhh ...!!"


````
### configuration for "framework.messenger"

````
symfony console debug:config FrameworkBundle messenger
````
# See all messages
symfony console messenger:failed:show -vv

# retry message one-by-one
symfony console messenger:failed:retry -vv

# retry specific messages
symfony console messenger:failed:retry 20 30 --force

# Remove without retrying
symfony console messenger:failed:remove 20



Then access the application in your browser at the given URL (<https://localhost:8000> by default).

Tests
-----
Execute this command to run tests:

```bash
$ cd my_project/
$ ./bin/phpunit
```


