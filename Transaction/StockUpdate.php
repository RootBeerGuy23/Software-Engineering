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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="../Assets/img/logo.png">
    <link rel="stylesheet" href="../Assets/css/updatestock.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <h2><a href="../Transaction/TransAction"><i class="fa-solid fa-arrow-left"></i> </a><u>Update Stock</u></h2>
    <form method="get" action="">
    <div class="rapi">
    <label>Choose Warehouse:</label>
    <div class="rapi2">
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
    </div>
    </diV>
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





