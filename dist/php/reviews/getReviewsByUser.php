<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $userId = $_GET['userId'];

    $query = new Database\Query();
    $response = $query->getReviewsByUser($userId);

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>