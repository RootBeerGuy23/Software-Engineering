<?php
include_once '../Auth/conn.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['Email']);
    $password = htmlspecialchars($_POST['password']);
    $current_time = date('Y-m-d H:i:s');

    // Query to get user information from the database
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $login_attempts = $row['login_attempts'];
        $is_locked = $row['is_locked'];
        $lockout_time = $row['lockout_time']; // Remove strtotime()

        // Check if the account is locked
        if ($is_locked && (strtotime($current_time) - strtotime($lockout_time)) < 900) { // 15 menit lockout
            // Block the account if it's still locked after 15 minutes
            $stmt = $conn->prepare("UPDATE users SET is_blocked = 1 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $_SESSION['error_message'] = "Akun Anda Terblokir. Silakan Hubungi Admin.";
            header("location: ../Auth/Login");
            exit;
        }


        if ($is_locked && (strtotime($current_time) - strtotime($lockout_time)) >= 900) { // 15 menit lockout
            // Persiapkan dan jalankan query update
            $stmt = $conn->prepare("UPDATE users SET is_locked = 0 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
        
            //Set pesan kesalahan dan arahkan pengguna ke halaman login
            $_SESSION['success_message'] = "Akun Anda Sudah Terbuka. Silakan Login Kembali .";
            $_SESSION['registered_username'] = $email;
            header("location: ../Auth/Login");
            exit;
        }

        // Check if the user is already logged in
        if ($row['is_logged_in']) { // Use $row['is_logged_in'] directly
            $_SESSION['LoggedIn'] = "Anda sudah login. Silakan logout terlebih dahulu.";
            header("location: ../Auth/Login");
            exit;
        }

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // If password matches, reset login attempts, set session, and update login status
            $stmt = $conn->prepare("UPDATE users SET login_attempts = 0, is_locked = 0, lockout_time = NULL, is_logged_in = 1 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $_SESSION['NIK'] = $row['NIK'];

            // Insert login information into login_history table
            $insert_log_query = "INSERT INTO login_history (NIK, ip_address, device_info) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_log_query);
            $stmt->bind_param("sss", $row['NIK'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
            $stmt->execute();

            header("location: ../index");
            exit;
        } else {
            // Password does not match, increment login attempts
            $login_attempts++;

            if ($login_attempts >= 3 && $is_locked) {
                // Block the account after 3 failed attempts
                $stmt = $conn->prepare("UPDATE users SET is_blocked = 1, login_attempts = ? WHERE email = ?");
                $stmt->bind_param("is", $login_attempts, $email);
                $stmt->execute();
                $_SESSION['error_message'] = "Akun Anda terblokir setelah lebih dari 3 kali percobaan gagal. Silakan hubungi admin.";
            } elseif ($login_attempts >= 2) {
                // Lock the account after 2 failed attempts
                $stmt = $conn->prepare("UPDATE users SET is_locked = 1, login_attempts = ?, lockout_time = ? WHERE email = ?");
                $stmt->bind_param("iss", $login_attempts, $current_time, $email);
                $stmt->execute();
                $_SESSION['error_message'] = "Akun Anda terkunci setelah 2 kali percobaan gagal. Silakan tunggu 15 menit.";
            } else {
                // Update login attempts
                $stmt = $conn->prepare("UPDATE users SET login_attempts = ? WHERE email = ?");
                $stmt->bind_param("is", $login_attempts, $email);
                $stmt->execute();
                $_SESSION['error_message'] = "Login gagal. Periksa kembali username dan password Anda.";
            }

            header("location: ../Auth/Login");
            exit;
        }
    } else {
        // Email not found, display error message
        $_SESSION['error_message'] = "Tidak Ada username atas Email '$email'";
        header("location: ../Auth/Login");
        exit;
    }
}


?>
