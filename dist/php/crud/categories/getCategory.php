<?php


require_once('../../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = new Database\Query();

        $category = $query->getCategory($id);

        if(!empty($category)){
            $exists = true;
        } else {
            $exists = false;
        }
    
        $response = ['exists' => $exists, 'category' => $category];
    
        header("Content-Type: application/json");
        echo json_encode($response);
    }

}


?>