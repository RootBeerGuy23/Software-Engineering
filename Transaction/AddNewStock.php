<?php
require '../Auth/conn.php';

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

// Proses menambah barang baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        echo "New item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Stock</title>
</head>
<body>
    <h1>Add New Stock</h1>
    <form method="post" enctype="multipart/form-data" action="AddNewStock.php">
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
