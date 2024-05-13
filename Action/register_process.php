<?php
session_start();
include_once '../Auth/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah username sudah digunakan
    $check_username_sql = "SELECT * FROM users WHERE username='$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        // Username sudah digunakan, set pesan kesalahan dan redirect ke halaman registrasi
        $_SESSION['error_message'] = "Registrasi gagal. Username sudah digunakan, silakan coba lagi dengan username lain.";
        header("location: ../Auth/Register.php");
        exit;
    }

    // Hash password menggunakan bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Query untuk menambahkan pengguna baru ke dalam database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil, set pesan sukses dan redirect ke halaman login
        $_SESSION['success_message'] = "Registrasi berhasil. Silakan login.";
        header("location: ../Auth/Login.php");
        exit;
    } else {
        // Terjadi kesalahan saat menambahkan pengguna baru, set pesan kesalahan dan redirect ke halaman registrasi
        $_SESSION['error_message'] = "Registrasi gagal. Silakan coba lagi.";
        header("location: ../Auth/Register.php");
        exit;
    }
}
?>
