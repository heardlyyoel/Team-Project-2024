<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .register-container {
            height: auto; width: 47%;
            height: 100%;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .register-header {
            display: flex;
            background-color: #FDFDFD;
            height: 180px;
            margin: 0 0;
            align-items: center;
            justify-content: center;
        }

        .register-header-image {
            height: 72px;
            margin-bottom: 12px;
            margin-right: 6px;
        }

        .register-header-h2 {
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

        .form__group, .form__group1 {
            position: relative;
            padding: 15px 0 0;
            margin-top: 10px;
            margin-bottom: 1.4rem;
            width: 80%;
        }

        .form__field, .form__field1 {
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
        }

        .form__field::placeholder, .form__field1::placeholder {
            color: transparent;
        }

        .form__field:placeholder-shown ~ .form__label,
        .form__field1:placeholder-shown ~ .form__label1 {
            font-size: 1.1rem;
            cursor: text;
            top: 20px;
        }

        .form__field:focus ~ .form__label,
        .form__field1:focus ~ .form__label1 {
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 0.9rem;
            color: #EFF2F9;
            font-weight: 600;
        }

        .form__field:focus, .form__field1:focus {
            padding-bottom: 6px;
            font-weight: 700;
            border-width: 3px;
            border-image: linear-gradient(to right, #FDFDFD, #FDFDFD);
            border-image-slice: 1;
        }
        
        .form__label, .form__label1 {
            font-family: 'Poppins-Medium';
            position: absolute;
            top: 0;
            display: block;
            transition: 0.2s;
            font-size: 1rem;
            color: #EFF2F9;
        }

        .register__button {
            font-family: 'Poppins-Bold';
            color: #062D52;
            background-color: #EFF2F9;
            width: 5rem;
            border: 1px solid #7e9cce;
        }

        .p__register {
            margin-left: 3.9rem;
            margin-bottom: 0;
            font-family: 'Poppins-Medium';
            font-size: 0.8rem;
            color:#EFF2F9;
        }

        .a__register {
            color: #7e9cce;
        }
    </style>
</head>
<body style="height: 100vh;">
    <div style="display: flex; justify-content: flex-end; height: 100%;">
        <div class="register-container">
            <div class="register-header">
                <img class="register-header-image" src="Images/logo-nav.svg">
                <h2 class="register-header-h2">Blibliobook</h2>
            </div>
            <div class="container_form">
                <form action="register_process.php" method="post" style="margin-bottom: 3rem;">
                    <div class="container_username_password">
                        <div class="form__group">
                            <input class="form__field" type="text" name="username" id="username" placeholder="Username" required>
                            <label for="username" class="form__label">Username</label>
                        </div>
                        <div class="form__group1">
                            <input class="form__field1" type="password" name="password" id="password" placeholder="Password" required>
                            <label for="password" class="form__label1">Password</label>
                        </div>
                        <div class="form__group1">
                            <input class="form__field1" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            <label for="confirm_password" class="form__label1">Confirm Password</label>
                        </div>
                        <div class="form__group1">
                            <input class="form__field1" type="text" name="phone" id="phone" pattern="[0-9]+" placeholder="Phone Number" required>
                            <label for="phone" class="form__label1">Phone Number</label>
                        </div>
                        <div class="form__group1">
                            <input class="form__field1" type="text" name="location" id="location" placeholder="Location" required>
                            <label for="location" class="form__label1">Location</label>
                        </div>
                    </div>
                    <button class="register__button" type="submit" style="margin: 1.6rem 1rem 2rem 3.8rem;">Register</button>
                </form>
                <p class="p__register">Already have an account? <a class="a__register" href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
