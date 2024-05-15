<?php
include_once '../Auth/conn.php';
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Stock</title>
</head>
<body>
    <h1>Add New Stock</h1>
    <form method="post" enctype="multipart/form-data" action="../Action/AddNewStock_process.php">
        <label for="id">ID:</label>
        <input type="number" name="id" required><br><br>
        
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br><br>
        
        <label for="stock">Stock:</label>
        <input type="number" name="stock" required><br><br>
        
        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*" required><br><br>

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
</body>
</html>
