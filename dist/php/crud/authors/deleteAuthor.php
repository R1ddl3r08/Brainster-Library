<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $authorId = $_POST['authorId'];

    if($authorId){
        $query = new Database\Query();
        $query->deleteAuthor($authorId);
        $response['success'] = true;
    } else{
        $response['success'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>