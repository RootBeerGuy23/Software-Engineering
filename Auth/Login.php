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
        <label for="Email">Email</label><br>
        <input type="email" id="Email" name="Email" value="<?php echo isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : ''; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
        
        <p>Belum punya akun? <a href="Register">Registrasi di sini</a></p>
    </form>
</body>
</html>


<?php 
unset($_SESSION['registered_username']);
?>