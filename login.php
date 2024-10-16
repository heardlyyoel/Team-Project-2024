<?php
session_start();

require_once 'db_connection.php';
$db = new DBConnection();
$conn = $db->getConnection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM account WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['account_id'] = $user['account_id'];
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password, Check Again');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-container {
            height: auto; width: 47%;
            height: 100%;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

            .login-header {
                display: flex;
                background-color: #FDFDFD;
                height: 180px;
                margin: 0 0;
                align-items: center;
                justify-content: center;
            }

            .login-header-image {
                height: 72px;
                margin-bottom: 12px;
                margin-right: 6px;
            }

            .login-header-h2 {
                color: #062D52;
                font-family: 'Kollektif-Bold';
                font-size: 82px;
                text-decoration: none;
                position: relative;
            }

            .container_form {
                display: flex;
                background-color: #062D52;
                flex-grow: 1;
                justify-content: center;
                flex-direction: column;
                padding-bottom: 2rem;
            }

            .container_username_password {
                display:flex;
                justify-content:center;
                flex-direction: column;
                align-items: center;
            }

            .form__group {
                position: relative;
                padding: 15px 0 0;
                margin-top: 10px;
                margin-bottom: 1.4rem;
                width: 80%;
            }

            .form__field {
            font-family: inherit;
            width: 100%;
            border: 0;
            border-bottom: 2px solid ;
            outline: 0;
            font-size: 1.3rem;
            color: #EFF2F9;
            padding: 7px 0;
            background: transparent;
            transition: border-color 0.2s;

            &::placeholder {
                color: transparent;
            }

            &:placeholder-shown ~ .form__label {
                font-size: 1.1rem;
                cursor: text;
                top: 20px;
            }

            &:focus {
                ~ .form__label {
                position: absolute;
                top: 0;
                display: block;
                transition: 0.2s;
                font-size: 0.9rem;
                color: #EFF2F9;
                font-weight: 600;
                }
                padding-bottom: 6px;
                font-weight: 700;
                border-width: 3px;
                border-image: linear-gradient(to right, #FDFDFD, #FDFDFD);
                border-image-slice: 1;
            }
            
              &:required,
              &:invalid {
                box-shadow: none;
              }
            }

            .form__label {
              font-family: 'Poppins-Medium';
              position: absolute;
              top: 0;
              display: block;
              transition: 0.2s;
              font-size: 1rem;
              color: #EFF2F9;
            }

            .form__group1 {
              position: relative;
              padding: 15px 0 0;
              margin-top: 10px;
              width: 80%;
              margin-bottom: 1.8rem;
            }

            .form__field1 {
              font-family: inherit;
              width: 100%;
              border: 0;
              border-bottom: 2px solid ;
              outline: 0;
              font-size: 1.3rem;
              color: #EFF2F9;
              padding: 7px 0;
              background: transparent;
              transition: border-color 0.2s;
            
              &::placeholder {
                color: transparent;
              }
            
              &:placeholder-shown ~ .form__label1 {
                font-size: 1.1rem;
                cursor: text;
                top: 20px;
              }

              &:focus {
                ~ .form__label1 {
                  position: absolute;
                  top: 0;
                  display: block;
                  transition: 0.2s;
                  font-size: 0.9rem;
                  color: #EFF2F9;
                  font-weight: 600;
                }
                padding-bottom: 6px;
                font-weight: 700;
                border-width: 3px;
                border-image: linear-gradient(to right, #FDFDFD, #FDFDFD);
                border-image-slice: 1;
              }
            
              &:required,
              &:invalid {
                box-shadow: none;
              }
            }

            .form__label1 {
              font-family: 'Poppins-Medium';
              position: absolute;
              top: 0;
              display: block;
              transition: 0.2s;
              font-size: 1rem;
              color: #EFF2F9;
            }

            .login__button {
              font-family: 'Poppins-Bold';
              color: #062D52;
              background-color: #EFF2F9;
              width: 5rem;
              border: 1px solid #7e9cce;
            }

            .p__login {
              margin-left: 3.9rem;
              margin-bottom: 0;
              font-family: 'Poppins-Medium';
              font-size: 0.8rem;
              color:#EFF2F9;
            }

            .a__login {
              color: #7e9cce;
            }
    </style>
</head>
<body style="height: 100vh;">
    <div style="display: flex;
    justify-content: flex-end;  height: 100%;">
        <div class="login-container">
            <div class="login-header">
                <img class="login-header-image" src="Images/logo-nav.svg">
                <h2 class="login-header-h2">Blibliobook</h2>
            </div>
            <div class="container_form">
                <form action="" method="post" style="margin-bottom: 3rem;">
                  <div class="container_username_password">
                    <div class="form__group">
                      <input class="form__field" type="text" name="username" id="username" placeholder="Username" required>
                      <label for="username" class="form__label">Username</label>
                    </div>
                    <div class="form__group1">
                      <input class="form__field1" type="password" name="password" id="password" placeholder="Password" required>
                      <label for="password" class="form__label1">Password</label>
                    </div>
                  </div>
                    <button class="login__button" type="submit" style="margin: 1.6rem 1rem 2rem 3.8rem;">Login</button>
                </form>
                <p class="p__login">Don't have an account? <a class="a__login" href="register.php">Register</a></p>
                <p class="p__login">Forgot your password? <a class="a__login" href="forgot_password.php">Reset Password</a></p>
            </div>
            
        </div>
    </div>
</body>
</html>