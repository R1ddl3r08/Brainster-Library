<?php

require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $query = new Database\Query();

    $response = $query->getBooks();

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>