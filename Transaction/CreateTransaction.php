<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Transaction</title>
</head>
<body>
    <h2>Input Transaction</h2>
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
                <input type="text" class="item_code" name="item_code[]" required><br>
                
                <label for="item_name">Item Name:</label><br>
                <input type="text" class="item_name" name="item_name[]" required><br>
                
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
        
        <input type="submit" value="Submit">
    </form>

    <script>
        function addItem() {
            var container = document.getElementById("itemFieldsContainer");
            var newItemField = document.createElement("div");
            newItemField.className = "itemFields";

            newItemField.innerHTML = `
                <label for="item_code">Item Code:</label><br>
                <input type="text" class="item_code" name="item_code[]" required><br>
                
                <label for="item_name">Item Name:</label><br>
                <input type="text" class="item_name" name="item_name[]" required><br>
                
                <label for="total_pcs">Total PCS:</label><br>
                <input type="number" class="total_pcs" name="total_pcs[]" required><br>
                
                <label for="description">Description:</label><br>
                <textarea class="description" name="description[]"></textarea><br>
                
                <label for="Harga">Harga:</label><br>
                <input type="text" class="Harga" name="Harga[]" required step="any"></><br>
            `;
            container.appendChild(newItemField);
        }
    </script>
</body>
</html>
