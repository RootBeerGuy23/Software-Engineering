<?php
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
