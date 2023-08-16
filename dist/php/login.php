<?php


require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $query = new Database\Query();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $response = ["loggedIn" => false, "messages" => []];

    if(!($query->userExists('username', $username))){
        $response['messages']['username'] = "The user doesn't exist";
    } else if (!($query->validatePassword($username, $password))) {
        $response['messages']['password'] = "Password is incorrect";
    }

    if(empty($response['messages'])){
        $userRole = $query->checkRole($username);
        $response['role'] = $userRole;
        $response['loggedIn'] = true;
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $userRole;
    }

    header("Content-Type: application/json");
    echo json_encode($response);

}


?>