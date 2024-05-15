<?php
session_start();
include_once '../Auth/conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $dob = htmlspecialchars($_POST['dob']);
    $department = htmlspecialchars($_POST['department']);
    $confirm_password = htmlspecialchars($_POST['passwordRetype']);

    // Ambil NIK terakhir yang ada di tabel users
    $sql_last_nik = "SELECT NIK FROM users ORDER BY NIK DESC LIMIT 1";
    $result = $conn->query($sql_last_nik);
    if ($result->num_rows > 0) {
        $last_nik_row = $result->fetch_assoc();
        $last_nik = $last_nik_row['NIK'];

        // Parsing NIK terakhir dan tambahkan 1
        $new_nik = $last_nik + 1;
    } else {
        // Jika tabel users masih kosong, mulai dari 11111
        $new_nik = 11111;
    }

    // Periksa apakah username sudah digunakan
    $check_email_sql = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = $conn->query($check_email_sql);

    if ($check_email_result->num_rows > 0) {
        // Username sudah digunakan, set pesan kesalahan dan redirect ke halaman registrasi
        $_SESSION['error_message'] = "Registrasi gagal. Username sudah digunakan, silakan coba lagi dengan username lain.";
        header("location: ../Auth/Register");
        exit;
    }

    // Hash password menggunakan bcrypt
    $hashed_password = password_hash($confirm_password, PASSWORD_BCRYPT);

    // Query untuk menambahkan pengguna baru ke dalam database
    $sql = "INSERT INTO users (nik, username, email, dob, department, password) VALUES ('$new_nik', '$username', '$email', '$dob', '$department', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil, set pesan sukses dan redirect ke halaman login
        $_SESSION['success_message'] = "Registrasi berhasil. Silakan login.";
        $_SESSION['registered_username'] = $email;
        header("location: ../Auth/Login");
        exit;
    } else {
        // Terjadi kesalahan saat menambahkan pengguna baru, set pesan kesalahan dan redirect ke halaman registrasi
        $_SESSION['error_message'] = "Registrasi gagal. Silakan coba lagi.";
        header("location: ../Auth/Register");
        exit;
    }
}
?>
