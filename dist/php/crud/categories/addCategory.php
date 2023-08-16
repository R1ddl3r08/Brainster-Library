<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category = $_POST['category'];

    if(empty($category)){
        $response['errors'] = 'All fields are required';
        $respomse['success'] = false;
    } else {
        $query = new Database\Query();
        $query->addCategory($category);
        $response['success'] = true;
        $response['errors'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>