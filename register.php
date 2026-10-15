<?php
require_once __DIR__ . "/includes/db.php";

$message = "";
$messageType = "";

$username = "";
$email = "";

// Process registration form
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    // Validate required fields
    if (
        $username === "" ||
        $email === "" ||
        $password === "" ||
        $confirmPassword === ""
    ) {
        $message = "All fields are required.";
        $messageType = "error";

    } elseif (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
        $message = "Username must be 3-50 characters and contain only letters, numbers, and underscores.";
        $messageType = "error";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        $messageType = "error";

    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters long.";
        $messageType = "error";

    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match. Please try again.";
        $messageType = "error";

    } else {
        // Check for duplicate username or email
        $sql = "SELECT id FROM users
                WHERE username = ? OR email = ?
                LIMIT 1";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $message = "Something went wrong. Please try again.";
            $messageType = "error";
        } else {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "Username or email already exists.";
                $messageType = "error";
            } else {
                // Securely hash password
                $passwordHash = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                // Insert new account
                $insertSql = "INSERT INTO users
                    (username, email, password_hash)
                    VALUES (?, ?, ?)";

                $insertStmt = $conn->prepare($insertSql);

                if (!$insertStmt) {
                    $message = "Registration failed. Please try again.";
                    $messageType = "error";
                } else {
                    $insertStmt->bind_param(
                        "sss",
                        $username,
                        $email,
                        $passwordHash
                    );

                    if ($insertStmt->execute()) {
                        $message = "Registration successful! Your account has been created. You can now log in.";
                        $messageType = "success";

                        // Clear form fields after successful registration
                        $username = "";
                        $email = "";
                    } else {
                        $message = "Registration failed. Please try again.";
                        $messageType = "error";
                    }

                    $insertStmt->close();
                }
            }

            $stmt->close();
        }
    }
}

// Safely escape displayed text
function e($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | FinanceFlow</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Registration messages */
        .register-message {
            padding: 12px 14px;
            margin: 16px 0;
            border-radius: 9px;
            font-size: 14px;
            line-height: 1.5;
        }

        .register-message.success {
            color: #216b36;
            background: #e5f7e9;
            border: 1px solid #b8e6c2;
        }

        .register-message.error {
            color: #a12626;
            background: #fdeaea;
            border: 1px solid #f3c0c0;
        }

        .register-login-button {
            display: block;
            margin-top: 14px;
            padding: 12px;
            text-align: center;
            border-radius: 8px;
            background: #477a4c;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .register-login-button:hover {
            background: #35663a;
        }
    </style>
</head>
<body>

    <main class="login-container">

        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="logo">
                <span>💰</span>
                <h1>FinanceFlow</h1>
            </div>

            <h2>
                Start your journey to
                <span>financial freedom.</span>
            </h2>

            <p>
                Create your account to track your income, manage expenses,
                set budgets, and understand your financial habits.
            </p>

            <div class="finance-card">
                <div class="card-icon">📈</div>
                <div>
                    <small>Your financial journey starts here</small>
                    <strong>Spend smarter. Save better.</strong>
                </div>
            </div>
        </section>

        <!-- Registration Section -->
        <section class="login-section">
            <div class="login-card">
                <div class="login-icon">👤</div>

                <h2>Create Account</h2>
                <p class="login-subtitle">
                    Join FinanceFlow and take control of your money.
                </p>

                <!-- Success and error messages appear here -->
                <?php if ($message !== ""): ?>
                    <div
                        class="register-message <?= e($messageType) ?>"
                        role="status"
                        aria-live="polite"
                    >
                        <?= e($message) ?>
                    </div>
                <?php endif; ?>

                <?php if ($messageType !== "success"): ?>

                    <form action="register.php" method="POST">
                        <div class="input-group">
                            <label for="username">Username</label>
                            <div class="input-box">
                                <span>👤</span>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    placeholder="Choose a username"
                                    minlength="3"
                                    maxlength="50"
                                    pattern="[A-Za-z0-9_]+"
                                    value="<?= e($username) ?>"
                                    autocomplete="username"
                                    required
                                >
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="email">Email Address</label>
                            <div class="input-box">
                                <span>✉️</span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    value="<?= e($email) ?>"
                                    autocomplete="email"
                                    required
                                >
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-box">
                                <span>🔒</span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="At least 8 characters"
                                    minlength="8"
                                    autocomplete="new-password"
                                    required
                                >
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-box">
                                <span>🔐</span>
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    placeholder="Enter password again"
                                    minlength="8"
                                    autocomplete="new-password"
                                    required
                                >
                            </div>
                        </div>

                        <button type="submit" class="login-button">
                            Create Account →
                        </button>
                    </form>

                    <p class="register-text">
                        Already have an account?
                        <a href="index.php">Log in</a>
                    </p>

                <?php else: ?>

                    <a href="index.php" class="register-login-button">
                        Go to Login →
                    </a>

                <?php endif; ?>

            </div>
        </section>

    </main>

    <!-- Decorative Finance Elements -->
    <div class="coin coin-1" aria-hidden="true">$</div>
    <div class="coin coin-2" aria-hidden="true">¢</div>
    <div class="coin coin-3" aria-hidden="true">$</div>

    <div class="money money-1" aria-hidden="true">💵</div>
    <div class="money money-2" aria-hidden="true">💸</div>

</body>
</html>