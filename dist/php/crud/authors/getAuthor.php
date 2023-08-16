<?php


require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = new Database\Query();

        $author = $query->getAuthor($id);

        if(!empty($author)){
            $exists = true;
        } else {
            $exists = false;
        }
    
        $response = ['exists' => $exists, 'author' => $author];
    
        header("Content-Type: application/json");
        echo json_encode($response);
    }

}


?>