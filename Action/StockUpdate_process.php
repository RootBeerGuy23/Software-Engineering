<?php
require '../Auth/conn.php';

// Proses update stok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
}
?>
