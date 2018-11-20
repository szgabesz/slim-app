<?php
namespace App\Controllers;

use PsrHttpMessageServerRequestInterface as Request;
use PsrHttpMessageResponseInterface as Response;
use App\Models\Users;

class UsersController {

    public function __construct($container)
    {
        // make the container available in the class
        $this->container = $container;
    }

    public function index($request, $response)
    {
        // $create = Users::create([
        //     'name' => 'jane doe',
        //     'email' => 'janedoe@cloudways.com',
        //     'password' => 'iamstupid',
        // ]);
        // var_dump($create);
        $response->getBody()->write('will be insert');
    }

    public function getall($request, $response)
    {
        // $users = $this->container->db->table('users')->get();
        // foreach ($users as $user){
        //     echo $user->name . "</br>";
        //     echo $user->email . "</br>";
        // }
        return $response->getBody()->write(Users::all()->toJson());
    }
 
}
?>