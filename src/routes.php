<?php
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// $app->get('/hello', 'UsersController:index');
// $app->get('/get', 'UsersController:getall');

$app->get('/hello', function (Request $request, Response $response) {
    return $response->getBody()->write(Users::all()->toJson());
    // echo "hello";
});
 
?>