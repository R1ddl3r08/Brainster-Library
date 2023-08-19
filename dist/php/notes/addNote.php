<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $note = $_POST['note'];
    $userId = $_POST['userId'];
    $bookId = $_POST['bookId'];

    if(empty($note)){
        $response['success'] = false;
        $response['errors'] = "Note filed mustn't be empty!";
    } else {
        $query = new Database\Query();
        $query->addNote($userId, $bookId, $note);
        $response['success'] = true;
        $response['errors'] = "";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>