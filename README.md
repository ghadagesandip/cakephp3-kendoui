# CakePHP Application Skeleton

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.0.

This is an unstable repository and should be treated as an alpha.

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
