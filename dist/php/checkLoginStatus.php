<?php

session_start();

$response = [
    "loggedIn" => isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false,
    "role" => isset($_SESSION['role']) ? $_SESSION['role'] : null
];

header("Content-Type: application/json");
echo json_encode($response);

?>