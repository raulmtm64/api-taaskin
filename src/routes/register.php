<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

$app->post('/register', function (Request $request,Response $response){
            
    $email = $request->getParam('email');
    $pw = $request->getParam('password');
    $newPass = password_hash($pw, PASSWORD_DEFAULT);
    $nickname = $request->getParam('nick');
    $firstName = $request->getParam('first_name');
    if (($request->getParam('surname')) != ''){
        $surname = $request->getParam('surname');
    } else {
        $surname = '';
    }
    
    try{
        $db = new DB();
        $db = $db->dbConnect();
        $sqlQuery = "SELECT id_user, nick, email, password, typeof FROM users WHERE email = '$email' OR nick = '$nickname'";
        $result = $db->query($sqlQuery);
        
        if($result->rowCount() == 0){
            $pdo = new DB();
            $pdo = $pdo->dbConnect();
            $sqlInsert = "INSERT INTO users (nick, first_name_user, surname_user, password, email, avatar, typeof) 
                            VALUES (:nick, :fsname, :surname, :pwd, :email, :avatar, :typeof);";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->execute([
                'nick'=> $nickname, 
                'fsname' => $firstName, 
                'surname'=> $surname, 
                'pwd'=> $newPass, 
                'email'=> $email, 
                'avatar'=> '',
                'typeof'=>'noadmin'
            ]);
            $result = null;
            $sqlQuery = "SELECT id_user, nick, email, password, typeof FROM users WHERE email = '$email' OR nick = '$nickname'";
            $result = $db->query($sqlQuery);
            if($result->rowCount() == 1){
                $users = $result->fetchAll(PDO::FETCH_OBJ);
                $array  = json_decode(json_encode($users[0]), true);
                echo json_encode($array);
            }
        } else {
            echo json_encode("El usuario ya existe en la base de datos.");
        }
        
        $db = null;
        $pdo = null;
        $stmt = null;
    } catch (PDOException $e){
        echo '{"error" : {"text":'.$e->getMessage().'}';
    }
});