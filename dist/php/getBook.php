<?php

require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = new Database\Query();

        $book = $query->getBook($id);

        if(!empty($book)){
            $exists = true;
        } else {
            $exists = false;
        }
    
        $response = ['exists' => $exists, 'book' => $book];
    
        header("Content-Type: application/json");
        echo json_encode($response);
    }

}


?>