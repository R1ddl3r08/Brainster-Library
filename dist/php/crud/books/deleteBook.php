<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $bookId = $_POST['bookId'];

    if($bookId){
        $query = new Database\Query();
        $query->deleteBook($bookId);
        $response['success'] = true;
    } else{
        $response['success'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>