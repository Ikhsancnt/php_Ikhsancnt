<?php
    $server   = "localhost"; 
    $username = "root";
    $password = "";
    $database = "testdb";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Failed to connect !" . $conn->connect_error);
    }
?>