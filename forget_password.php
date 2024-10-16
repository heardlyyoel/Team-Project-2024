<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form action="reset_password_process.php" method="post">
            <input type="text" name="email" placeholder="Email" required>
            <button type="submit">Reset Password</button>
        </form>
        <p>Remember your password? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
