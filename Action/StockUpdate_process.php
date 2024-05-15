<?php
session_start();
require '../Auth/conn.php';
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
// Proses update stok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($roleStatus == 1){
        $id = $_POST['id'];
        $action = $_POST['action'];
        $quantity = intval($_POST['quantity']);
        $warehouse = $_POST['warehouse'];
    
        // Ambil stok saat ini dari gudang tertentu
        $query = "SELECT jumlah_stok FROM warehouse_$warehouse WHERE id_barang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($current_stock);
        $stmt->fetch();
        $stmt->close();
    
        if ($action == 'add') {
            $new_stock = $current_stock + $quantity;
        } else if ($action == 'subtract') {
            $new_stock = $current_stock - $quantity;
            if ($new_stock < 0) {
                $new_stock = 0;
            }
        }
    
        // Update stok di tabel gudang yang sesuai
        $query = "UPDATE warehouse_$warehouse SET jumlah_stok = ? WHERE id_barang = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $new_stock, $id);
        $stmt->execute();
        $stmt->close();
    
        // Mengembalikan stok yang diperbarui sebagai respons
        echo $new_stock;
} else{
    header("HTTP/1.1 403 Forbidden");
    echo "You are not authorized to access this page.";
    
    exit;

}
}
?>
