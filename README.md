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
3. Copy app.default.php file to app.php
4. Create tmp and logs dir and set write permission to these dirs.
5. create database import database from db/cake3-kendoui.sql dir.
6. set databse connection in config/app.php file
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
6. create a virtual host(eg dev.cakekendo.com) and Go to http://dev.cakekendo.com/admin/users
7. use following credentials for login
 > username : sandip@gmail.com
 > password : sandip

# Kendoui documentation important links
1) grid api : http://docs.telerik.com/kendo-ui/api/javascript/ui/grid
