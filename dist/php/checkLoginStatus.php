<?php

session_start();

$response = ["loggedIn" => isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true];
header("Content-Type: application/json");
echo json_encode($response);

?>