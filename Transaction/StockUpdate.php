<?php
session_start();
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}
require '../Auth/conn.php';



// Ambil semua data barang dari gudang tertentu
if(isset($_GET['warehouse'])) {
    $warehouse = $_GET['warehouse'];
    $query = "SELECT id_barang, nama_barang, jumlah_stok FROM warehouse_$warehouse";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Stock</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    <form method="get" action="">
    <label>Choose Warehouse:</label><br>
    <?php
    // Ambil daftar nama gudang dari database
    $sql = "SELECT table_name FROM information_schema.tables WHERE table_name LIKE 'warehouse_%'";
    $result_warehouse = $conn->query($sql);

    if ($result_warehouse->num_rows > 0) {
        while($row_warehouse = $result_warehouse->fetch_assoc()) {
            // Ambil nama gudang dari nama tabel dan tampilkan sebagai opsi
            $warehouse_name = str_replace("warehouse_", "", $row_warehouse['table_name']);
            $checked = (isset($_GET['warehouse']) && $_GET['warehouse'] == strtolower($warehouse_name)) ? 'checked' : '';
            echo "<label><input type=\"radio\" name=\"warehouse\" value=\"" . strtolower($warehouse_name) . "\" $checked>" . ucfirst($warehouse_name) . "</label><br>";
        }
    }
    ?>
    <button type="submit">Submit</button>
</form>

    <?php if(isset($result)) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id_barang']; ?></td>
        <td><?php echo $row['nama_barang']; ?></td>
        <td id="stock_<?php echo $row['id_barang']; ?>"><?php echo $row['jumlah_stok']; ?></td>
        <td>
            <input type="hidden" name="warehouse" value="<?php echo $_GET['warehouse']; ?>">
            <input type="number" name="quantity" id="quantity_<?php echo $row['id_barang']; ?>" min="1" required>
            <button type="button" class="update-btn" data-id="<?php echo $row['id_barang']; ?>" data-action="add">Add</button>
            <button type="button" class="update-btn" data-id="<?php echo $row['id_barang']; ?>" data-action="subtract">Subtract</button>
        </td>
    </tr>
<?php } ?>

        </table>
    <?php } ?>
</body>
</html>


<script>
$(document).ready(function() {
    $('.update-btn').click(function() {
        var id = $(this).data('id');
        var action = $(this).data('action');
        var quantityInput = $('#quantity_' + id);
        var quantity = quantityInput.val();
        var warehouse = '<?php echo $_GET['warehouse']; ?>';
        
        $.ajax({
            url: '../Action/StockUpdate_process.php',
            type: 'POST',
            data: {id: id, action: action, quantity: quantity, warehouse: warehouse},
            success: function(response) {
                // Cek apakah respons merupakan pesan kesalahan
                if (response.startsWith('You are not authorized')) {
                    // Jika ya, tampilkan pesan kesalahan
                    $('body').append("<p style='color:red'>" + response + "</p>");
                } else {
                    // Jika tidak, lakukan pembaruan stok seperti biasa
                    $('#stock_' + id).text(response);
                    // Mengosongkan nilai input setelah berhasil memperbarui stok
                    quantityInput.val('');
                }
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan AJAX di sini
                console.error(xhr.responseText);
                // Tampilkan pesan kesalahan
                $('body').append("<p style='color:red'>You Have No Permission.</p>");
            }
        });
    });
});

</script>





