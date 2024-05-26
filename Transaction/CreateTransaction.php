<?php
session_start();
include_once '../Auth/conn.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}

if (isset($_SESSION['No_Permission'])) {
    echo "<p style='color:red'>" . $_SESSION['No_Permission'] . "</p>";
    unset($_SESSION['No_Permission']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Stock</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="../Assets/img/logo.png">
    <link rel="stylesheet" href="../Assets/css/createtransaction.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    <h2><u>Input Transaction</u></h2>
    <form action="../Action/CreateTransaction_process.php" method="post" id="transactionForm">
        <label for="receiver">Receiver:</label><br>
        <input type="text" id="receiver" name="receiver" required><br>
        
        <label for="sender">Sender:</label><br>
        <input type="text" id="sender" name="sender" required><br>
        
        <label for="datetime">Date and Time:</label><br>
        <input type="datetime-local" id="datetime" name="datetime" required><br>
        
        <label for="waybill_number">Waybill Number:</label><br>
        <input type="text" id="waybill_number" name="waybill_number" disabled><br>
        
        <label for="sender_address">Sender Address:</label><br>
        <textarea id="sender_address" name="sender_address" required></textarea><br>
        
        <label for="order_number">Order Number:</label><br>
        <input type="text" id="order_number" name="order_number" disabled><br>

        <!-- Container for dynamically added item fields -->
        <div id="itemFieldsContainer">
            <!-- Initial item fields -->
            <div class="itemFields">
                <label for="item_code">Item Code:</label><br>
                <!-- <input type="text" class="item_code" name="item_code[]" required><br> -->
                <select id="item_code" name="item_code[]" required>
    <?php
    // Menyiapkan query untuk mengambil daftar barang dari database
    $sql_items = "SELECT id, item_name, stock FROM items where stock > 0";
    $result_items = mysqli_query($conn, $sql_items);

    // Menampilkan pilihan barang dari hasil query
    while ($row = mysqli_fetch_assoc($result_items)) {
        echo "<option value='" . $row['id'] . "'>" . $row['item_name'] . " (Stock: " . $row['stock'] . ")</option>";
    }
    ?>
</select><br>
                
                <label for="item_name">Item Name:</label><br>
                <!-- <input type="text" class="item_name" name="item_name[]" required><br> -->
                 <select id="item_name" name="item_name[]" required>
    <?php
    // Menyiapkan query untuk mengambil daftar barang dari database
    $sql_name = "SELECT item_name FROM items where stock > 0";
    $result_name = mysqli_query($conn, $sql_name);

    // Menampilkan pilihan barang dari hasil query
    while ($rows = mysqli_fetch_assoc($result_name)) {
        echo "<option value='" . $rows['item_name'] . "'>" . $rows['item_name'] .  "</option>";
    }
    ?>
</select><br>
            
                

                
                <label for="total_pcs">Total PCS:</label><br>
                <input type="number" class="total_pcs" name="total_pcs[]" required><br>
                
                <label for="description">Description:</label><br>
                <textarea class="description" name="description[]"></textarea><br>

                <label for="Harga">Harga:</label><br>
                <input type="text" class="Harga" name="Harga[]" required step="any"></><br>
            </div>
        </div>

        <!-- Button to add new item fields -->
        <button type="button" onclick="addItem()">Tambah Barang</button><br>
        
        <input id="submit"type="submit" value="Submit">
    </form>

    <script>
    function addItem() {
        var container = document.getElementById("itemFieldsContainer");
        var newItemField = document.createElement("div");
        newItemField.className = "itemFields";

        newItemField.innerHTML = `
            <label for="item_code">Item Code:</label><br>
            <label for="item_code">Item Code:</label><br>
                <!-- <input type="text" class="item_code" name="item_code[]" required><br> -->
                <select id="item_code" name="item_code[]" required>
    <?php
    // Menyiapkan query untuk mengambil daftar barang dari database
    $sql_items = "SELECT id, item_name, stock FROM items where stock > 0";
    $result_items = mysqli_query($conn, $sql_items);

    // Menampilkan pilihan barang dari hasil query
    while ($row = mysqli_fetch_assoc($result_items)) {
        echo "<option value='" . $row['id'] . "'>" . $row['item_name'] . " (Stock: " . $row['stock'] . ")</option>";
    }
    ?>
</select><br>
                
                <label for="item_name">Item Name:</label><br>
                <!-- <input type="text" class="item_name" name="item_name[]" required><br> -->
                 <select id="item_name" name="item_name[]" required>
    <?php
    // Menyiapkan query untuk mengambil daftar barang dari database
    $sql_name = "SELECT item_name FROM items where stock > 0";
    $result_name = mysqli_query($conn, $sql_name);

    // Menampilkan pilihan barang dari hasil query
    while ($rows = mysqli_fetch_assoc($result_name)) {
        echo "<option value='" . $rows['item_name'] . "'>" . $rows['item_name'] .  "</option>";
    }
    ?>
</select><br>

            <label for="total_pcs">Total PCS:</label><br>
            <input type="number" class="total_pcs" name="total_pcs[]" required><br>

            <label for="description">Description:</label><br>
            <textarea class="description" name="description[]"></textarea><br>
            
            <label for="Harga">Harga:</label><br>
            <input type="text" class="Harga" name="Harga[]" required step="any"><br>
        `;
        container.appendChild(newItemField);
    }
</script>

</body>
</html>
