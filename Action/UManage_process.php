<?php 

include '../Auth/conn.php'; // Sertakan file koneksi
date_default_timezone_set('Asia/Jakarta');
// Fungsi untuk memperbarui data pengguna
if(isset($_POST['update'])){
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $department = $_POST['department'];
    $login_attempts = $_POST['login_attempts'];
    $is_locked = $_POST['is_locked'];
    $lockout_time = $_POST['lockout_time'];
    $lockout_time = date('Y-m-d H:i:s', strtotime($lockout_time));
    $role_status = $_POST['role_status'];
    $is_logged_in = $_POST['is_logged_in'];
    $is_blocked = $_POST['is_blocked'];
    
    // Query untuk memperbarui data pengguna
    $update_query = "UPDATE users SET username='$username', email='$email', dob='$dob', department='$department', login_attempts='$login_attempts', is_locked='$is_locked', lockout_time='$lockout_time', role_status='$role_status', is_logged_in='$is_logged_in', is_blocked='$is_blocked' WHERE NIK='$nik'";
    
    if(mysqli_query($conn, $update_query)){
       $_SESSION['success_message'] = "Updated Successfully!";
        header("location: ../Internal/UserManagement");
    } else {
        $_SESSION['error_message'] = "Update Failed!";
        header("location: ../Internal/UserManagement");
    }
}



?>
