<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Store Spehere INC</title>
        <link rel="icon" href="Assets/img/logo.png">
        <link rel="stylesheet" href="../Assets/css/register.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="captcha.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
        <a href="index.php">
            <img src="Assets/img/logo.png" alt="Link Logo">
        </a>
        </div>
        <div class="menu">
            <a href="index.html" >Home</a>
            <a href="#contact">Contact</a>
            <a href="services.html">Services</a>
        </div>
    </nav>
    </header>

    <div class="container">
    <h2>Registrasi Pengguna</h2>
    <?php 
     if(isset($_SESSION['error_message'])) {
        echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']); // Hapus pesan kesalahan setelah ditampilkan
    }

    // Tampilkan pesan sukses jika ada
    if(isset($_SESSION['success_message'])) {
        echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
        unset($_SESSION['success_message']); // Hapus pesan sukses setelah ditampilkan
    }
    ?>
    <form action="../Action/register_process.php" method="post" id="registrationForm">

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" readonly><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="dob">Date Of Birth:</label><br>
        <input type="date" id="dob" name="dob"><br>

        <label for="nik">NIK:</label><br>
        <input type="text" id="nik" name="nik" oninput="validateNIK(this);" maxlength="5" disabled placeholder="This Is AutoGenerate Function"><br>

        <label for="department">Department:</label><br>
        <select name="department" id="department">
            <option value="HR">HR</option>
            <option value="IT">IT</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select><br>

        
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
        
            <label for="passwordRetype">Retype Password:</label><br>
            <input type="password" id="passwordRetype" name="passwordRetype"><br><br>
        
            <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password <br><br>
       

        <div class="captcha-box">
            <span id="captchaText"></span>
            <span class="captcha-refresh" onclick="generateCaptcha()"><button type="button">refresh</button></span>
        </div><br><br>
        <input type="text" id="captcha" name="captcha" placeholder="Enter the text above"><br>
        <input type="hidden" id="hiddenCaptcha"><br><br>
        
        <input type="submit" value="Registrasi">
    </form>
    </div>

    <script>
        function ValidatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("passwordRetype").value;
            
            // Regular expression for password validation
            var passwordRegex = /^(?=.*[A-Z]).{8,}$/;
            
            if (!passwordRegex.test(password)) {
                document.getElementById("password").setCustomValidity("Password must be at least 8 characters long and contain at least one uppercase letter.");
                return false;
            } else {
                document.getElementById("password").setCustomValidity('');
            }

            if (password !== confirmPassword) {
                document.getElementById("passwordRetype").setCustomValidity("Passwords do not match.");
                return false;
            } else {
                document.getElementById("passwordRetype").setCustomValidity('');
            }

            return true;
        }

        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("passwordRetype");
            var passwordFieldType = passwordField.type === "password" ? "text" : "password";
            passwordField.type = passwordFieldType;
            confirmPasswordField.type = passwordFieldType;
        }

        function generateUsername() {
            var email = document.getElementById("email").value;
            var usernameField = document.getElementById("username");

            var emailParts = email.split('@');
            if (emailParts.length > 1) {
                var nameParts = emailParts[0].split('.');
                if (nameParts.length > 0) {
                    var firstName = nameParts[0].replace(/\d+/g, ''); // Remove any digits
                    usernameField.value = firstName;
                }
            }
        }

        document.getElementById("email").addEventListener('input', generateUsername);
        document.getElementById("password").addEventListener('input', ValidatePassword);
        document.getElementById("passwordRetype").addEventListener('input', ValidatePassword);

        document.getElementById("registrationForm").addEventListener('submit', function(event) {
            if (!ValidatePassword()) {
                event.preventDefault(); // Prevent form submission
                alert("Please fix the errors in the form before submitting.");
            }
        });
    </script>
</body>
</html>
