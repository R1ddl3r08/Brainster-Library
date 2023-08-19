<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $bookId = $_GET['bookId'];

    $query = new Database\Query();
    $response = $query->getReviewsByBook($bookId);

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>