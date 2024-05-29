<?php
include '../Auth/conn.php'; // Sertakan file koneksi
session_start();
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}
if(isset($_SESSION['NIK'])) {
    $NIK = $_SESSION['NIK'];
    $sqlRole = "SELECT role_status FROM users WHERE NIK = ?";
    $stmtRole = $conn->prepare($sqlRole);
    $stmtRole->bind_param("i", $NIK);
    $stmtRole->execute();
    $resultRole = $stmtRole->get_result();
    if($resultRole->num_rows > 0) {
        $rowRole = $resultRole->fetch_assoc();
        $roleStatus = $rowRole['role_status']; // peran pengguna
    } else {
        // Jika NIK tidak ditemukan
        echo "NIK not found.";
        exit;
    }
    $stmtRole->close();
} else {
    // Jika sesi NIK tidak ada
    echo "Session NIK not found.";
    exit;
}

if ($roleStatus != 1) {
    echo "<script>alert('You Are Not Allowed To Access This Page');</script>"; 
    header("location: ../   ");
    exit;   
}



// Fungsi untuk mengubah status notifikasi
function changeNotificationStatus($status) {
    file_put_contents('Notification/NotificationStatus.txt', $status);
}

// Jika tombol "Aktifkan Notifikasi" ditekan
if(isset($_POST['activate_notification'])) {
    changeNotificationStatus(1); // Aktifkan notifikasi
    echo "<script>alert('Notifikasi telah diaktifkan.');</script>";
}

// Jika tombol "Matikan Notifikasi" ditekan
if(isset($_POST['disable_notification'])) {
    changeNotificationStatus(0); // Matikan notifikasi
    echo "<script>alert('Notifikasi telah dimatikan.');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Server Notification Settings</title>
</head>
<body>
    <h2>Server Notification Settings</h2>
    
    <!-- Form untuk mengaktifkan notifikasi -->
    <form method="post" action="">
        <button type="submit" name="activate_notification">Aktifkan Notifikasi</button>
    </form>
    
    <!-- Form untuk mematikan notifikasi -->
    <form method="post" action="">
        <button type="submit" name="disable_notification">Matikan Notifikasi</button>
    </form>
</body>
</html>
