<?php
session_start();

// Protect dashboard from users who are not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . "/includes/db.php";

// Get current user's name
$username = htmlspecialchars($_SESSION["username"] ?? "User", ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlow | Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f6f8f1;
            color: #26352b;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 6%;
            background: white;
            border-bottom: 1px solid #e5eadf;
        }

        .brand {
            color: #477a4c;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar a {
            color: #477a4c;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .card p {
            color: #718073;
            margin: 0 0 15px;
        }

        .amount {
            font-size: 27px;
            font-weight: bold;
        }

        .balance {
            background: #e6f1dc;
        }

        .actions {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .actions a {
            padding: 13px 18px;
            border-radius: 9px;
            background: #477a4c;
            color: white;
            text-decoration: none;
        }

        .note {
            color: #718073;
            margin-top: 25px;
            font-size: 14px;
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 16px 20px;
            }

            .container {
                margin-top: 25px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="brand">FinanceFlow</div>
    <a href="logout.php">Logout</a>
</nav>

<main class="container">
    <section class="welcome">
        <h1>Welcome back, <?= $username ?>!</h1>
        <p>Here's an overview of your personal finances.</p>
    </section>

    <section class="cards">
        <div class="card balance">
            <p>Available Balance</p>
            <div class="amount">Rs. 0.00</div>
        </div>

        <div class="card">
            <p>Total Income</p>
            <div class="amount">Rs. 0.00</div>
        </div>

        <div class="card">
            <p>Total Expenses</p>
            <div class="amount">Rs. 0.00</div>
        </div>

        <div class="card">
            <p>Monthly Budget</p>
            <div class="amount">Not Set</div>
        </div>
    </section>

    <section class="actions">
        <a href="income.php">+ Add Income</a>
        <a href="expense.php">− Add Expense</a>
        <a href="transactions.php">View Transactions</a>
        <a href="budget.php">Manage Budget</a>
    </section>

    <p class="note">
        Your financial summary will update automatically once transaction
        tracking and budget management are connected to the database.
    </p>
</main>

</body>
</html>
