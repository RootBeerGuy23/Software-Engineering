<?php
include_once '../Auth/conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['Email']);
    $password = htmlspecialchars($_POST['password']);

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
        $lockout_time = strtotime($row['lockout_time']);
        $is_logged_in = $row['is_logged_in']; // Fetch the is_logged_in status

        // Check if the account is locked
        if ($is_locked && time() - $lockout_time > 900) { // 15 minutes lockout
            $_SESSION['error_message'] = "Akun Anda terkunci. Silakan coba lagi setelah 15 menit.";
            header("location: ../Auth/Login");
            exit;
        }

        // Check if the user is already logged in
        if ($is_logged_in) { // If is_logged_in is 1, the user is already logged in
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

            // Get information for login log
            $user_NIK = $row['NIK'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $device_info = $_SERVER['HTTP_USER_AGENT'];

            // Insert login information into login_history table
            $insert_log_query = "INSERT INTO login_history (NIK, ip_address, device_info) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_log_query);
            $stmt->bind_param("sss", $user_NIK, $ip_address, $device_info);
            $stmt->execute();

            header("location: ../index");
            exit;
        } else {
            // Password does not match, increment login attempts
            $login_attempts++;
            if ($login_attempts >= 3) {
                // Lock the account after 3 failed attempts
                $stmt = $conn->prepare("UPDATE users SET is_locked = 1, lockout_time = NOW(), login_attempts = ? WHERE email = ?");
                $stmt->bind_param("is", $login_attempts, $email);
                $stmt->execute();
                $_SESSION['error_message'] = "Akun Anda terkunci setelah 3 kali percobaan gagal. Silakan coba lagi setelah 15 menit.";
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
