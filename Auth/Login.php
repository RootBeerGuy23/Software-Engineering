<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .captcha-box {
            display: inline-block;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-weight: bold;
            font-size: 18px;
            user-select: none; /* Prevent text selection */
            cursor: default;    /* Change cursor to default */
        }
        .captcha-refresh {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            margin-left: 10px;
            user-select: none; /* Prevent text selection */
        }
    </style>
    <script src="captcha.js"></script> <!-- Update the path to your captcha.js file -->
</head>
<body>
    <h2>Login</h2>

    <?php 
        if (isset($_SESSION['error_message'])) {
            echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']);
        }

        if (isset($_SESSION['success_message'])) {
            echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
        }
    ?>

    <form action="../Action/login_process.php" method="post" onsubmit="return validateCaptcha()">
        <label for="Email">Email</label><br>
        <input type="email" id="Email" name="Email" value="<?php echo isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : ''; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="captcha">Captcha:</label><br>
        <div class="captcha-box">
            <span id="captchaText"></span>
            <span class="captcha-refresh" onclick="generateCaptcha()"><button type="button">refresh</button></span>
        </div><br>
        <input type="text" id="captcha" name="captcha" placeholder="Enter the text above"><br>
        <input type="hidden" id="hiddenCaptcha"><br><br>

        <input type="submit" value="Login">
        
        <p>Belum punya akun? <a href="Register">Registrasi di sini</a></p>
    </form>
</body>
</html>

<?php 
unset($_SESSION['registered_username']);
?>
