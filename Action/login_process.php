<?php
include_once '../Auth/conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username =  htmlspecialchars($_POST['username']);
   $password =  htmlspecialchars($_POST['password']);
    // $username = $_POST['username'];
    // $password = $_POST['password'];

    // Query untuk mengambil hash password pengguna dari database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Memeriksa apakah password cocok dengan hash yang tersimpan
        if (password_verify($password, $hashed_password)) {
            // Jika cocok, set session dan redirect ke halaman utama
            $_SESSION['username'] = $username;
            header("location: ../index.php");
            exit;
        } else {
            // Password tidak cocok, tampilkan pesan kesalahan
            $_SESSION['error_message'] = "Login gagal. Periksa kembali username dan password Anda.";
            header("location: ../Auth/Login.php");
            exit;
        }
    } else {
        // Username tidak ditemukan, tampilkan pesan kesalahan
        $_SESSION['error_message'] = "Tidak Ada username atas Nama '$username'";
        header("location: ../Auth/Login.php");
        exit;
    }
}
?>
