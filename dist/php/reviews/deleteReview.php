<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $reviewId = $_POST['reviewId'];

    $query = new Database\Query();
    $query->deleteReview($reviewId);
    $response['success'] = true;

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>