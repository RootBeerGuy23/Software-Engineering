<?php
session_start();
include_once '../Auth/conn.php';

if (isset($_SESSION['NIK'])) {
    // Ambil NIK pengguna dari session
    $nik = $_SESSION['NIK'];

    // Ambil informasi tambahan jika diperlukan, seperti alamat IP atau informasi perangkat
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $device_info = $_SERVER['HTTP_USER_AGENT'];

    // Query untuk menyimpan informasi logout ke dalam tabel logout_history
    $sql = "INSERT INTO logout_history (NIK, ip_address, device_info) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nik, $ip_address, $device_info);
    $stmt->execute();

    // Query untuk mengupdate status is_logged_in menjadi 0
    $update_sql = "UPDATE users SET is_logged_in = 0 WHERE NIK = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("s", $nik);
    $update_stmt->execute();
}

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
header("location: Login");
exit;
?>
