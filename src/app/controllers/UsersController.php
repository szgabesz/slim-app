<?php
 
namespace app\controllers;
use app\models\Users;
 
class HomeController extends Controller
{
 
    public function index($request, $response)
    {
        $create = Users::create([
            'name' => 'jane doe',
            'email' => 'janedoe@cloudways.com',
            'password' => 'iamstupid',
        ]);
        var_dump($create);
    }

    public function getall($request, $response)
    {
        $users = $this->container->db->table('users')->get();
        foreach ($users as $user){
            echo $user->name . "</br>";
            echo $user->email . "</br>";
        }
    }
 
}
?>