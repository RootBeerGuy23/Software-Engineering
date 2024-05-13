<?php 
session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

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
    


    <form action="../Action/login_process.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
        
        <p>Belum punya akun? <a href="Register.php">Registrasi di sini</a></p>
    </form>
</body>
</html>
