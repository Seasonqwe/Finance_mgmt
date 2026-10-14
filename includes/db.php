<?php
$host = "db";
$username = "finance_user";
$password = "FinanceFlow_App_2026!";
$database = "finance_manager";  

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    http_response_code(500);
    exit("Unable to connect to the database.");
}

$conn->set_charset("utf8mb4");
?>
