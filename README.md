Symfony 5 Api Starter
=====================

The "Symfony 5 Api Starter" can be used as the base code to start an API using jwt authentication.  

Requirements
------------

  * PHP 7.2 or higher;
  * and the [usual Symfony application requirements][2].

Installation
------------

Create a directory, and clone the repo in it.  

    git clone https://github.com/igorbalden/sf5-api.git ./

  	php composer.phar install

Copy `./env` to `.env.local`. Edit it, if so needed.  

Create a MySql database and run the migration.  


Usage
-----

If you have [installed Symfony][4] binary, run this command:

```bash
$ cd my_project/
$ symfony serve -d
```

Then start the client application to use it,  
or query it with a tool like curl or similar.  

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`  
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.

Tests
-----

Execute this command to run tests:

```bash
$ cd my_project/
$ ./bin/phpunit
```

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
