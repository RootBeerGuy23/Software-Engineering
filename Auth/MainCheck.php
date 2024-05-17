<?php
session_start();
if(isset($_SESSION['NIK'])){
    // $_SESSION['No_Login'] = "No Login Session Found, Please Login First!";
    header("location: ../index");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Store Spehere INC</title>
        <link rel="icon" href="Assets/img/logo.png">
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
    <h2>Selamat Datang!</h2>
    <p>Silakan pilih opsi untuk melanjutkan:</p>
    <ul>
        <li><a href="Login">Login</a></li>
        <li><a href="Register">Registrasi</a></li>
    </ul>
    </section>  
</body>
</html>











