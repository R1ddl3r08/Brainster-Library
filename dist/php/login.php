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
        $user = $query->getUser($username);
        $response['role'] = $user['role'];
        $response['userId'] = $user['id'];
        $response['loggedIn'] = true;
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['userId'] = $user['id'];
    }

    header("Content-Type: application/json");
    echo json_encode($response);

}


?>