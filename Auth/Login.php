<?php 
session_start();
if(isset($_SESSION['NIK'])){
    // $_SESSION['No_Login'] = "No Login Session Found, Please Login First!";
    header("location: ../index");
    exit;
}
?>
<DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Store Spehere INC</title>
        <link rel="icon" href="Assets/img/logo.png">
        <link rel="stylesheet" href="../Assets/css/login.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="../Assets/js/captcha.js"></script>
    </head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
        <a href="index.php">
            <img src="../Assets/img/logo.png" alt="Link Logo">
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
            <br><br><br>
            <form action="../Action/login_process.php" method="post" onsubmit="return validateCaptcha()">
                <div class="Login">
                    <h1 id="judul">Login</h1>
                    <br>
                    <?php 
             if (isset($_SESSION['error_message'])) {
            echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']);
            }

             if (isset($_SESSION['success_message'])) {
            echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
            }

            if (isset($_SESSION['LoggedIn'])) {
                echo "<p style='color:red'>" . $_SESSION['LoggedIn'] . "</p>";
                unset($_SESSION['LoggedIn']);
                }

            
            
    ?>

   
            <input type="email" placeholder="Email" id="Email" name="Email" value="<?php echo isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : ''; ?>"><br>
            <input type="password" placeholder="Password" id="password" name="password"><br><br>
            <label for="captcha">Captcha:</label><br>
            <div class="captcha-box">
            <span id="captchaText"></span>
            <span class="captcha-refresh" onclick="generateCaptcha()"><button type="button">refresh</button></span>
            </div><br>
            <input type="text" id="captcha" name="captcha" placeholder="Enter the text above"><br>
            <input type="hidden" id="hiddenCaptcha"><br><br>
             <button type="submit" >Login</button>

            <h4>Don't have account? <a href="Register">register </a>now</h4>
            </form>
                </div>
              
        
        </div>

    <footer>
          <div class="kosong"></div>
    </footer>
</body>
</html>
<?php 
unset($_SESSION['registered_username']);
?>


<script>
    document.addEventListener("keydown", function(event) {
    if (event.key === "F12") {
        event.preventDefault(); // Menghentikan aksi default (buka console developer)
        alert("Oops, it's not allowed!");
    }
});

</script>