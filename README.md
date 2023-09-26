# Environment variable manager in PHP

Simplifying Environment Variable Management.

## Install

```shell
composer require natanael-oliveira/dot-env
```

## Example of use

A new `.env` file will be created at the root of your project, you can manually insert your environment variables or define them dynamically using the `set()` method:

```php
<?php

require 'vendor/autoload.php';
use NatanaelOliveira\DotEnv\Environment;

// Create an instance of the Environment class
$env = new Environment();

// Set the environment variables
$env->set('DB_HOST', 'host');
$env->set('DB_USER', 'user');
$env->set('DB_PASS', 'password');
$env->set('DB_PREFIX', 'db_prefix_');

// Get environment variables
$dbHost = $env->get('DB_HOST');
$dbUser = $env->get('DB_USER', 'default_user');
$dbPass = $env->get('DB_PASS');

// Remove environment variables
$env->remove('DB_PREFIX');

// Use environment variables in your application
echo "DB Host: $dbHost<br>";
echo "DB User: $dbUser<br>";
echo "DB Password: $dbPass<br>";

```

## Requirements

This library needs PHP 7.4 or greater.