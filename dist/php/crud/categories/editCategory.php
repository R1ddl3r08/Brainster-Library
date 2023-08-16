<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $categoryId = $_POST['categoryId'];
    $category = $_POST['category'];

    if(empty($category)){
        $response['errors'] = "All fields are required";
        $response['success'] = false;
    } else {
        $query = new Database\Query();
        $query->updateCategory($categoryId, $category);
        $response['success'] = true;
        $response['errors'] = '';
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>