<?php
require '../Auth/conn.php';

// Ambil peran pengguna dari basis data berdasarkan NIK yang disimpan dalam sesi
session_start();
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

// Proses menambah barang baru hanya untuk peran yang diizinkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek izin berdasarkan peran
    if ($roleStatus == 1) { // Hanya admin yang diizinkan menambah barang baru
        $id = intval($_POST['id']);
        $item_name = $_POST['item_name'];
        $description = $_POST['description'];
        $stock = intval($_POST['stock']);
        $image_path = '../Assets/img/items/';
        $current_date = date("Y-m-d H:i:s");

        // Proses upload gambar
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../Assets/img/items/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    exit;
                }
            } else {
                echo "File is not an image.";
                exit;
            }
        }

        // Get warehouse from form
        $warehouse = $_POST['warehouse'];

        // Insert data ke database
        $query = "INSERT INTO $warehouse (id_barang, nama_barang, jumlah_stok, last_audit, last_update, image_path, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ississs", $id, $item_name, $stock, $current_date, $current_date, $image_path, $description);
        if ($stmt->execute()) {
            header("Location: ../Transaction/AddNewStock.php");
            echo "New item added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Jika peran tidak diizinkan
        header("Location: ../Transaction/AddNewStock.php");
        $_SESSION['No_Permission'] = "You do not have permission to perform this action.";
        // echo "You do not have permission to perform this action.";
        exit;
    }
}
?>
