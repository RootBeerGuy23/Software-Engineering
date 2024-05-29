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
    header("location: ../");
    exit;   
}


if (isset($_SESSION['error_message'])) {
    echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']);
    }
if (isset($_SESSION['success_message'])) {
            echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']);
    }




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company User Management</title>
    <link rel="icon" href="../Assets/img/logo.png">
    <link rel="stylesheet" href="../Assets/css/InternalManagement.css">
</head>
<body>
    <h1>Company User Management</h1>
    <table>
        <tr>
            <th>NIK</th>
            <th>Username</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Update DOB</th>
            <th>Department</th>
            <th>Login Attempts</th>
            <th>Is Locked</th>
            <th>Lockout Time</th>
            <th>Role Status</th>
            <th>Is Logged In</th>
            <th>Is Blocked</th>
            <th>Action</th>
        </tr>
        <?php


        // Query untuk mendapatkan data pengguna dari database
        $select_query = "SELECT * FROM users";
        $result = mysqli_query($conn, $select_query);
        // Tampilkan data pengguna dalam tabel
        while($row = mysqli_fetch_assoc($result)){
            
            echo "<tr>";
            echo "<form method='post' action='../Action/UManage_process.php'>";
            echo "<input type='hidden' name='nik' value='" . $row["NIK"] . "'>";
            echo "<td>" . $row["NIK"] . "</td>";
            echo "<td><input type='text' name='username' value='" . $row["username"] . "'></td>";
            echo "<td><input type='email' name='email' value='" . $row["email"] . "'></td>";
            echo "<td><input type='text' name='dobView' value='" . $row["dob"] . "'></td>";
            echo "<td><input type='date' name='dob' value='" . $row["dob"] . "'></td>";
            echo "<td><input type='text' name='department' value='" . $row["department"] . "'></td>";
            echo "<td><input type='text' name='login_attempts' value='" . $row["login_attempts"] . "'></td>";
            echo "<td><input type='text' name='is_locked' value='" . $row["is_locked"] . "'></td>";
            echo "<td><input type='datetime-local' name='lockout_time' value='" . $row["lockout_time"] . "'></td>";
            echo "<td><input type='text' name='role_status' value='" . $row["role_status"] . "'></td>";
            echo "<td><input type='text' name='is_logged_in' value='" . $row["is_logged_in"] . "'></td>";
            echo "<td><input type='text' name='is_blocked' value='" . $row["is_blocked"] . "'></td>";
            echo "<td><input type='submit' name='update' value='Update'></td>";
            echo "</form>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
