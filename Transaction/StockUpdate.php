<?php
require '../Auth/conn.php';

// Proses update stok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];
    $quantity = intval($_POST['quantity']);

    // Ambil stok saat ini
    $query = "SELECT stock FROM items WHERE id = ?";
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

    // Update stok
    $query = "UPDATE items SET stock = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $new_stock, $id);
    $stmt->execute();
    $stmt->close();
}

// Ambil semua data barang
$query = "SELECT id, item_name, description, stock FROM items";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Stock</title>
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
        form {
            display: inline-block;
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Update Stock</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td>
                <form method="post" action="StockUpdate.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="quantity" min="1" required>
                    <button type="submit" name="action" value="add">Add</button>
                    <button type="submit" name="action" value="subtract">Subtract</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
