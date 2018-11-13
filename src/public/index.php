<?php
require __DIR__ . '/../vendor/autoload.php';
require  __DIR__ . '/../models/Users.php';  
require  __DIR__ . '/../handlers/exception.php';

// Instantiate the app
$app = new \Slim\App(['settings' => require __DIR__ . '/../config/settings.php']);

$container = $app->getContainer();
$settings = $container->get('settings');

$container = $app->getContainer();

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

// $app->get('/hello', function (Request $request, Response $response, array $args) {
//     return $response->getBody()->write(Users::all()->toJson());
// });

// require_once('../routes.php');
require  __DIR__ . '/../routes.php';

$app->run();
