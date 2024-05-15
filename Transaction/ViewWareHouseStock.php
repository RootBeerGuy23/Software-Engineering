<?php 
session_start();
include_once '../Auth/conn.php';
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}


    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Array untuk menyimpan nama tabel gudang
    $warehouses = array("CHINA", "JAKARTA", "BATAM", "BOGOR");

    // Loop untuk menampilkan data dari setiap tabel gudang
    foreach ($warehouses as $warehouse) {
        echo "<h2>Warehouse $warehouse</h2>";
        $sql = "SELECT id_barang, nama_barang, jumlah_stok, last_audit, last_update, description, image_path FROM warehouse_$warehouse";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID Barang</th><th>Nama Barang</th><th>Jumlah Stok</th><th>Last Audit</th><th>Last Update</th><th>Description</th><th>Image</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id_barang"]."</td><td>".$row["nama_barang"]."</td><td>".$row["jumlah_stok"]."</td><td>".$row["last_audit"]."</td><td>".$row["last_update"]."</td><td>".$row["description"]."</td><td>"."<img src=\"".$row["image_path"]."\">"."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data di Warehouse $warehouse";
        }
    }

    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Warehouse Dashboard</h1>


</body>
</html>
