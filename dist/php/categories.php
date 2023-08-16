<?php

require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $query = new Database\Query();

    $response = $query->getAll('categories');

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>