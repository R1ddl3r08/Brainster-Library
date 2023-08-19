<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $userId = $_GET['userId'];
    $bookId = $_GET['bookId'];

    $query = new Database\Query();
    $response = $query->getNotesByUserAndBook($userId, $bookId);

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>