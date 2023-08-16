<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $categoryId = $_POST['categoryId'];

    if($categoryId){
        $query = new Database\Query();
        $query->deleteCategory($categoryId);
        $response['success'] = true;
    } else{
        $response['success'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>