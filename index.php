<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FinanceFlow - Login</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Decorative finance elements -->
    <div class="coin coin-1">$</div>
    <div class="coin coin-2">$</div>
    <div class="coin coin-3">¢</div>

    <div class="money money-1">💵</div>
    <div class="money money-2">💸</div>

    <!-- Main Login Section -->
    <div class="login-container">

        <!-- Left Side -->
        <div class="welcome-section">

            <div class="logo">
                <span>💰</span>
                <h1>FinanceFlow</h1>
            </div>

            <h2>
                Take control of<br>
                your <span>finances.</span>
            </h2>

            <p>
                Track your income, expenses and savings
                all in one simple place.
            </p>

            <div class="finance-card">
                <div class="card-icon">📈</div>

                <div>
                    <small>Monthly Savings</small>
                    <strong>$2,450.00</strong>
                </div>
            </div>

        </div>


        <!-- Login Card -->
        <div class="login-section">

            <div class="login-card">

                <div class="login-icon">
                    💵
                </div>

                <h2>Welcome Back!</h2>

                <p class="login-subtitle">
                    Login to manage your finances
                </p>


                <form action="login.php" method="POST">

                    <!-- Username -->
                    <div class="input-group">

                        <label for="username">
                            Username
                        </label>

                        <div class="input-box">
                            <span>👤</span>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Enter your username"
                                required
                            >
                        </div>

                    </div>


                    <!-- Password -->
                    <div class="input-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-box">
                            <span>🔒</span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword()"
                            >
                                👁
                            </button>
                        </div>

                    </div>


                    <div class="login-options">

                        <label class="remember">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>

                        <a href="#">Forgot Password?</a>

                    </div>


                    <button type="submit" class="login-button">
                        Login
                        <span>→</span>
                    </button>

                </form>


                <p class="register-text">
                    Don't have an account?
                   <a href="register.html">Create an account</a>
                </p>

            </div>

        </div>

    </div>


    <script src="js/script.js"></script>

</body>
</html>