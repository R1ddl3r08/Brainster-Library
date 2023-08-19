<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $reviewId = $_POST['reviewId'];
    $status = $_POST['status'];

    $query = new Database\Query();
    $query->changeReviewStatus($status, $reviewId);

    $response['success'] = true;

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>