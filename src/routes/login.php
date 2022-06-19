<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$app->post('/login', function (Request $request,Response $response){
            
    $user = $request->getParam('email');
    $pw = $request->getParam('password');
    $sqlQuery = "SELECT id_user, nick, email, password, typeof FROM users WHERE email = '$user'";

    try{
        $db = new DB();
        $db = $db->dbConnect();
        $result = $db->query($sqlQuery);

        if($result->rowCount() == 1){
            $users = $result->fetchAll(PDO::FETCH_OBJ);
            $array  = json_decode(json_encode($users[0]), true);
            $hashedPass = $array["password"];
            if (password_verify($pw, $hashedPass)){
                echo json_encode($array);
            }
        } else {
            echo json_encode("Usario o contraseña incorrecto");
        }
        $result = null;
        $db = null;
    } catch (PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});