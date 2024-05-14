<?php
session_start();
include_once 'Auth/conn.php';

// Memeriksa apakah pengguna sudah login
if(!isset($_SESSION['NIK'])){
    header("location: Auth/MainCheck");
    exit;
}

$NIK = $_SESSION['NIK'];

// Query untuk mengambil nama pengguna berdasarkan NIK
$sql = "SELECT username FROM users WHERE NIK='$NIK'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    // Tampilkan nama pengguna
    echo "Halo, $username!";
} else {
    echo "Nama pengguna tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="Assets/img/logo.png">
    <link rel="stylesheet" href="Assets/css/index.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
                <a href="#services">Services</a>
                <a href="#about">About</a>
            </div>
        </nav>
    </header>
    <div class="word">
        <?php echo 'Hai,' . $username; ?>
        <a href="Auth/Logout" id="logoutLink">Logout</a>
        <h3>"Optimalkan Operasi Gudang dengan Web Storage Management: <br> Solusi Efisien unutk Logistik Modern!"</h3>
        <button type="submit">Explore Now !!!</button>
        <!-- <img src="Assets/img/logistics.jpg" alt=""> -->
    </div>
<div>
    <img src="Assets/img/logistics.jpg" alt="">
</div>
    <footer>
        <li>Terms & Conditions</li>
        <li>Accessibility</li>
        <li>FAQ</li>
        <li>Cookies Policy</li>
    </footer>
</body>
</html>


<script>
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault();
        var confirmLogout = confirm('Yakin mau logout?');
        if (confirmLogout) {
            window.location.href = 'Auth/Logout';
        }
    });
</script>