<?php
require '../Auth/conn.php';

// Ambil semua data barang
$query = "SELECT id, item_name, description, stock, image_path FROM items";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Stock</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <h1>View Stock</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Image</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td>
                <?php if (!empty($row['image_path'])) { ?>
                    <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['item_name']; ?>">
                <?php } else { ?>
                    No Image
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
