<?php
require '../Auth/conn.php';

// Ambil semua data barang dari gudang tertentu
if(isset($_GET['warehouse'])) {
    $warehouse = $_GET['warehouse'];
    $query = "SELECT id_barang, nama_barang, jumlah_stok, last_audit, last_update, image_path,description FROM Warehouse_$warehouse";
    $result = $conn->query($query);
}
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
    <form method="get" action="">
        <label for="warehouse">Choose Warehouse:</label>
        <select name="warehouse" onchange="this.form.submit()">
            <option value=""></option>
            <?php
            
            // Ambil daftar nama gudang dari database
            $sql = "SELECT table_name FROM information_schema.tables WHERE table_name LIKE 'warehouse_%'";
            $result_warehouse = $conn->query($sql);

            if ($result_warehouse->num_rows > 0) {
                while($row_warehouse = $result_warehouse->fetch_assoc()) {
                    // Ambil nama gudang dari nama tabel dan tampilkan sebagai opsi
                    $warehouse_name = str_replace("warehouse_", "", $row_warehouse['table_name']);
                    echo "<option value=\"" . strtolower($warehouse_name) . "\"";
                    if(isset($_GET['warehouse']) && $_GET['warehouse'] == strtolower($warehouse_name)) {
                        echo " selected";
                    }
                    echo ">" . ucfirst($warehouse_name) . "</option>";
                }
            }
            ?>
        </select>
    </form>
    <?php if(isset($result)) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Stock</th>
                <th>Last Audit</th>
                <th>Last Update</th>
                <th>Image</th>
                <th>Description</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><?php echo $row['jumlah_stok']; ?></td>
                    <td><?php echo $row['last_audit']; ?></td>
                    <td><?php echo $row['last_update']; ?></td>
                    <td>
                        <?php if (!empty($row['image_path'])) { ?>
                            <img src="<?php echo $row['image_path']; ?>">
                        <?php } else { ?>
                            No Image
                        <?php } ?>
                    </td>
                    <td><?php echo $row['description']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>
</html>
