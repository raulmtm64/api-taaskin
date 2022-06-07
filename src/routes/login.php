<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

// require '../src/config/db.php';

$app->get('/login', function (Request $request,Response $response){
    $user = $request->getParam('email');
    $pw = $request->getParam('password');
    
    // $connec = new DB();
    // $connec = $connec->dbConnect();
    // $sqlQuery = "SELECT * FROM users WHERE email = `${email}` AND passwd = `${pw}`";
    // $stmt = $connec->prepare($sqlQuery);
    
    // $stmt->execute();

    // while($registro=$stmt->fetch(PDO::FETCH_ASSOC)){
    //     print_r($registro);
    // }

    // $connec = null;




    // try{
    //     $db = new DB();
    //     $db = $db->dbConnect();
    //     $result = $db->query($sqlQuery);

    //     if($result->rowCount() >0){
    //         $users = $result->fetchAll(PDO::FETCH_OBJ);
    //         echo json_encode($users);
    //     } else {
    //         echo json_encode("No existen usuarios");
    //     }
    //     $result = null;
    //     $db = null;
    // } catch (PDOException $e){
    //     echo '{"error" : {"text":'.$e->getMessage().'}'-;
    // }
    echo "Hola";
});