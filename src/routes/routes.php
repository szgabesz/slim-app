<?php
 
$app->get('/users', 'UsersController:index');
$app->get('/getall', 'UsersController:getall');

// $app->get('/users', function (Request $request, Response $response) {
//     return $response->getBody()->write(Users::all()->toJson());
// });

// $app->get('/users/{id}', function (Request $request, Response $response, $args) { 
//     return $response->getBody()->write(Users::find($args['id'])->toJson());
// });
 
?>