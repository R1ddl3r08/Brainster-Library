<?php

require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $bookId = $_POST['bookId'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publicationYear = $_POST['publicationYear'];
    $numberOfPages = $_POST['numberOfPages'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    if(empty($title) || ($author == 0) || empty($publicationYear) || empty($numberOfPages) || empty($image) || ($category == 0)){
        $response['errors'] = "All fields are required";
        $response['success'] = false;
    } else {
        $query = new Database\Query();
        $query->updateBook($bookId, $title, $author, $publicationYear, $numberOfPages, $image, $category);
        $response['success'] = true;
        $response['errors'] = '';
    }

    header("Content-Type: application/json");
    echo json_encode($response);
}


?>