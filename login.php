<?php
session_start();

require_once __DIR__ . "/includes/db.php";

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// Get form data
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

// Validate required fields
if ($username === "" || $password === "") {
    header("Location: index.php?error=empty");
    exit();
}

// Validate username format
if (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
    header("Location: index.php?error=username");
    exit();
}

// Find account in database
$sql = "SELECT id, username, email, password_hash, role, status
        FROM users
        WHERE username = ?
        LIMIT 1";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: index.php?error=server");
    exit();
}

$stmt->bind_param("s", $username);

if (!$stmt->execute()) {
    $stmt->close();
    header("Location: index.php?error=server");
    exit();
}

$result = $stmt->get_result();

// Check if username exists
if ($result->num_rows !== 1) {
    $stmt->close();
    header("Location: index.php?error=invalid");
    exit();
}

$user = $result->fetch_assoc();

// Verify password
if (!password_verify($password, $user["password_hash"])) {
    $stmt->close();
    header("Location: index.php?error=invalid");
    exit();
}

// Check account status
if ($user["status"] !== "active") {
    $stmt->close();
    header("Location: index.php?error=inactive");
    exit();
}

// Login successful - prevent session fixation
session_regenerate_id(true);

$_SESSION["user_id"] = $user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];

$stmt->close();
$conn->close();

header("Location: dashboard.php");
exit();