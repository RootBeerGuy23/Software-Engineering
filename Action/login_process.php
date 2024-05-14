<?php
include_once '../Auth/conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email =  htmlspecialchars($_POST['Email']);
   $password =  htmlspecialchars($_POST['password']);


    // Query untuk mengambil hash password pengguna dari database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Memeriksa apakah password cocok dengan hash yang tersimpan
        if (password_verify($password, $hashed_password)) {
            // Jika cocok, set session dan redirect ke halaman utama
            $_SESSION['NIK'] = $row['NIK'];

            // Ambil informasi yang diperlukan untuk log login
            $user_NIK = $row['NIK'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $device_info = $_SERVER['HTTP_USER_AGENT'];

            // Query untuk menyimpan informasi login ke dalam tabel login_history
            $insert_log_query = "INSERT INTO login_history (NIK, ip_address, device_info) VALUES ('$user_NIK', '$ip_address', '$device_info')";
            $conn->query($insert_log_query);
            
            header("location: ../index");
            exit;
        } else {
            // Password tidak cocok, tampilkan pesan kesalahan
            $_SESSION['error_message'] = "Login gagal. Periksa kembali username dan password Anda.";
            header("location: ../Auth/Login");
            exit;
        }
    } else {
        // Username tidak ditemukan, tampilkan pesan kesalahan
        $_SESSION['error_message'] = "Tidak Ada username atas Email '$email'";
        header("location: ../Auth/Login");
        exit;
    }
}
?>
