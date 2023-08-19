<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $note = $_POST['note'];
    $noteId = $_POST['noteId'];

    if(!empty($note)){
        $query = new Database\Query();
        $query->editNote($noteId, $note);
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>