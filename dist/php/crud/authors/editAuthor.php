<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $authorId = $_POST['authorId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $shortBio = $_POST['shortBio'];

    if(empty($firstName) || empty($lastName) || empty($shortBio)){
        $response['errors'] = "All fields are required";
        $response['success'] = false;
    } else {
        $query = new Database\Query();
        $query->updateAuthor($authorId, $firstName, $lastName, $shortBio);
        $response['success'] = true;
        $response['errors'] = '';
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>