<?php
require '../Auth/conn.php';

// Proses menambah barang baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $stock = intval($_POST['stock']);
    $image_path = '../Assets/img/items/';

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

    // Insert data ke database
    $query = "INSERT INTO items (id, item_name, description, stock, image_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issis", $id, $item_name, $description, $stock, $image_path);
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
        
        <button type="submit">Add Item</button>
    </form>
</body>
</html>
