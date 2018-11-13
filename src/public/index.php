<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// require '../vendor/autoload.php';

require __DIR__ . '/../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = '';
$config['db']['dbname'] = 'exampleapp';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('./logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$app->get('/', function (Request $request, Response $response, array $args) {
    echo "This is a base url";
    $this->logger->addInfo('This is a base url');
});

$app->get('/hello', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello");
    $this->logger->addInfo('Hello');
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    $this->logger->addInfo("Hello, $name");

    return $response;
});

$app->get('/tickets', function (Request $request, Response $response) {
    $this->logger->addInfo("Ticket list");
    $mapper = new TicketMapper($this->db);
    $tickets = $mapper->getTickets();

    $response->getBody()->write(var_export($tickets, true));
    return $response;
});


$app->run();
