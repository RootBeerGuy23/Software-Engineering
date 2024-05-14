<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pengguna</title>
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

        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
        
            <label for="passwordRetype">Retype Password:</label><br>
            <input type="password" id="passwordRetype" name="passwordRetype"><br><br>
        
            <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password <br><br>
        </div>

        <div class="captcha-box">
            <span id="captchaText"></span>
            <span class="captcha-refresh" onclick="generateCaptcha()"><button type="button">refresh</button></span>
        </div><br><br>
        <input type="text" id="captcha" name="captcha" placeholder="Enter the text above"><br>
        <input type="hidden" id="hiddenCaptcha"><br><br>
        
        <input type="submit" value="Registrasi">
    </form>

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
