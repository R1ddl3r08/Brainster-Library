<?php

require_once('autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $query = new Database\Query();

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $response = ["success" => false, "messages" => []];

    if(empty($email)){
        $response['messages']['email'] = 'Email is required';
    } elseif ($query->userExists('email', $email)) {
        $response['messages']['email'] = 'The email is already in use';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['messages']['email'] = 'Please enter a valid email';
    }
    
    if(empty($username)){
        $response['messages']['username'] = 'Username is required';
    } elseif ($query->userExists('username', $username)) {
        $response['messages']['username'] = 'The username is taken';
    }

    if(empty($password)){
        $response['messages']['password'] = 'Password is required';
    }
    
    if (empty($confirmPassword)){
        $response['messages']['confirmPassword'] = 'Please confirm your password';
    } elseif ($password !== $confirmPassword) {
        $response['messages']['confirmPassword'] = "Passwords don't match";
    }

    if (empty($response['messages'])) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $response["success"] = true;
        $query->registerUser($email, $username, $hashedPassword);
    } else {
        $response["success"] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}
?>