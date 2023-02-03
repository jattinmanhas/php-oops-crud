<?php
    error_reporting(0);
    include_once "./database/database.php";
    include_once "./classes/operations.php";

    $database = new Database();
    $db = $database -> getConnection();

    $operation = new Operations($db);
    $result = $operation -> delete();
    header("Location: view.php");
?>