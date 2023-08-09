<?php
session_start();

session_destroy();

$response = ["loggedIn" => false];
header("Content-Type: application/json");
echo json_encode($response);
?>