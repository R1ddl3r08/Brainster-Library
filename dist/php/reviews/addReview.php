<?php


require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $comment = $_POST['comment'];
    $userId = $_POST['userId'];
    $bookId = $_POST['bookId'];

    if(empty($comment)){
        $response['success'] = false;
        $response['errors'] = "Review filed mustn't be empty!";
    } else {
        $query = new Database\Query();
        if($query->validateReview($userId, $bookId)){
            $query->addReview($userId, $bookId, $comment);
            $response['success'] = true;
            $response['errors'] = "";
        } else {
            $response['success'] = false;
            $response['errors'] = "You already left a review on this book";
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>