<?php
define('APPLICATION_ROOT', __DIR__.'/../');
define('APPLICATION_SRC', __DIR__.'/../src/');

$loader = require_once APPLICATION_ROOT . 'vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

require APPLICATION_SRC . 'Config.php';
require APPLICATION_SRC . 'bootstrap.php';
require APPLICATION_SRC . 'di.php';
require APPLICATION_SRC . 'routing.php';

$app->run();
