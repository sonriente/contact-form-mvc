<?php

use components\Application;
use helpers\Config;

require_once __DIR__ . '/components/MapAutoloader.php';
$autoloader = new components\MapAutoloader();

spl_autoload_register([$autoloader, 'autoload']);

$webConfig = require_once __DIR__ . '/configs/web.php';
Config::getInstance()->set($webConfig);

Application::set('config', Config::getInstance());
Application::set('template', (new \components\web\Template()));
Application::set('db', (new \components\Database(
    Config::getInstance()->get('db.host'),
    Config::getInstance()->get('db.user'),
    Config::getInstance()->get('db.password'),
    Config::getInstance()->get('db.name')
)));

echo components\Router::dispatch();
