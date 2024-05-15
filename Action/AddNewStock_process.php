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
        header("Location: ../Transaction/AddNewStock.php");
        echo "New item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
