
<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = "db";
$username = "finance_user";
$password = "FinanceFlow_App_2026!";
$database = "finance_manager";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection FAILED: " . $conn->connect_error);
}

echo "SUCCESS! PHP connected to MySQL.";
echo "<br>Database: " . $database;

$conn->close();
?>