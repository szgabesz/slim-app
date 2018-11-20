<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../models/Users.php');  
require_once(__DIR__ . '/../Controllers/UsersController.php');
// require_once(__DIR__ . '/../handlers/exception.php');//TODO

use App\Controller\UsersController as UsersController;

// Instantiate the app
$app = new \Slim\App(['settings' => require __DIR__ . '/../config/settings.php']);

$container = $app->getContainer();
$settings = $container->get('settings');

$container = $app->getContainer();

$container['UsersController'] = function ($c) {
    return new app\controllers\UsersController($c);
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
    IlluminateContractsDebugExceptionHandler::class,
    AppExceptionsHandler::class
  );

$container['logger'] = function($container) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

require_once(__DIR__ . '/../routes/routes.php');

$app->run();
