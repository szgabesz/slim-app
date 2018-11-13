<?php
return [
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'exampleapp',
        'username' => 'root',
        'password' => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix'    => '',
    ]
];

// var_dump($this->get('settings'));