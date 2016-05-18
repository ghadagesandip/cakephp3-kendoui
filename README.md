# CakePHP Application Skeleton

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.0.

This is an unstable repository and should be treated as an alpha.

## Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist -s dev cakephp/app [app_name]`.

If Composer is installed globally, run
```bash
composer create-project --prefer-dist -s dev cakephp/app [app_name]
```

You should now be able to visit the path to where you installed the app and see
the setup traffic lights.

## Configuration

Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application.

# how to setup application?
1. Clone repo
2. Run composer update command
```bash
composer update
```
3. Create tmp and logs dir and set write permission to these dirs.
4. create database and set database connection in config/app.php file as below

```php
'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'username',
            'password' => 'password',
            'database' => 'dbname',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
```

5. Run following command
```bash
bin/cake migrations migrate
```

6. Run following command to create admin user
```bash
bin/cake user add
```

7. Run following command to start application
```bash
bin/cake server
```

8. Go to admin login page
http://localhost:8765/admin


# Kendoui documentation important links
1) grid api : http://docs.telerik.com/kendo-ui/api/javascript/ui/grid
