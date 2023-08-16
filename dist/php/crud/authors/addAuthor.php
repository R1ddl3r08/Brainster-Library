<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $shortBio = $_POST['shortBio'];

    if(empty($firstName) || empty($lastName) || empty($shortBio)){
        $response['errors'] = 'All fields are required';
        $respomse['success'] = false;
    } else {
        $query = new Database\Query();
        $query->addAuthor($firstName, $lastName, $shortBio);
        $response['success'] = true;
        $response['errors'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>