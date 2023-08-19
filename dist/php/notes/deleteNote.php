<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $noteId = $_POST['noteId'];

    $query = new Database\Query();
    $query->deleteNote($noteId);
    $response['success'] = true;

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>