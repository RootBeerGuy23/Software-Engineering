<?php
session_start();
include_once '../Auth/conn.php';
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}
// Ambil daftar nama gudang dari database
$sql = "SELECT table_name FROM information_schema.tables WHERE table_name LIKE 'warehouse_%'";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan nama gudang
$warehouses = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Ambil nama gudang dari nama tabel dan simpan ke dalam array
        $warehouse_name = str_replace("warehouse_", "", $row['table_name']);
        $warehouses[] = ucfirst(strtolower($warehouse_name));
    }
}


if (isset($_SESSION['No_Permission'])) {
    echo "<p style='color:red'>" . $_SESSION['No_Permission'] . "</p>";
    unset($_SESSION['No_Permission']);
    }

    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="../Assets/img/logo.png">
    <link rel="stylesheet" href="../Assets/css/addstock.css">    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <section>
        <h1><a href="../Transaction/TransAction"><i class="fa-solid fa-arrow-left"></i></a> <u>Add New Stock</u></h1>
    <form method="post" enctype="multipart/form-data" action="../Action/AddNewStock_process.php">
        <label for="id">ID:</label>
        <input id="id" type="number" name="id" required><br><br>
        
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea name="description" required></textarea><br><br>
        
        <label for="stock">Stock:</label>
        <input id="stock" type="number" name="stock" required><br><br>
        
        <label for="image">Upload Image:</label><br>
        <input id="file" type="file" name="image" accept="image/*" required><br><br>

        <label for="warehouse">Choose Warehouse:</label>
        <select name="warehouse" required>
            <?php
            // Tampilkan nama-nama gudang sebagai opsi
            foreach ($warehouses as $warehouse_name) {
                echo "<option value=\"warehouse_" . strtolower($warehouse_name) . "\">" . ucfirst($warehouse_name) . "</option>";
            }
            ?>
        </select><br><br>
        
        <button type="submit">Add Item</button>
    </form>
    </section>
    
</body>
</html>
