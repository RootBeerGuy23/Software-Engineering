<?php
session_start();
if(isset($_SESSION['NIK'])){
    // $_SESSION['No_Login'] = "No Login Session Found, Please Login First!";
    header("location: ../index");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="../Assets/img/logo.png">
    <link rel="stylesheet" href="../Assets/css/maincheck.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>

<?php 
  if (isset($_SESSION['No_Login'])) {
    echo "<p style='color:red'>" . $_SESSION['No_Login'] . "</p>";
    unset($_SESSION['No_Login']);
    }

?>
    <section>
        <h2>Welcome to</h2>
        <img src="../Assets/img/logo.png" alt="">
        <h3>Please Login or Register to proceed :</h3>
        <div class="rapi">
            <a href="Login.php"> <button >Login</button> </a> <span>or</span>
            <a href="Register.php"><button>Register</button></a>
        </div>
    </section>
    <footer>

    </footer>
</body>
</html>











