<?php
session_start();
include_once '../Auth/conn.php';
if(isset($_SESSION['NIK'])) {
    $NIK = $_SESSION['NIK'];
    $sqlRole = "SELECT role_status FROM users WHERE NIK = ?";
    $stmtRole = $conn->prepare($sqlRole);
    $stmtRole->bind_param("i", $NIK);
    $stmtRole->execute();
    $resultRole = $stmtRole->get_result();
    if($resultRole->num_rows > 0) {
        $rowRole = $resultRole->fetch_assoc();
        $roleStatus = $rowRole['role_status']; // peran pengguna
    } else {
        // Jika NIK tidak ditemukan
        echo "NIK not found.";
        exit;
    }
    $stmtRole->close();
} else {
    // Jika sesi NIK tidak ada
    echo "Session NIK not found.";
    exit;
}




// Memeriksa apakah formulir telah dikirim
// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    if($roleStatus == 1){
// Memperoleh data dari formulir
$receiver = $_POST['receiver'];
$sender = $_POST['sender'];
$datetime = $_POST['datetime'];
$waybill_number = generateWaybillNumber(); // Menghasilkan nomor waybill secara acak
$sender_address = $_POST['sender_address'];
$order_number = $waybill_number;

// Menyiapkan query untuk memasukkan data transaksi ke dalam database
$sql_transaction = "INSERT INTO transactions (receiver, sender, datetime, waybill_number, sender_address, order_number) 
                    VALUES ('$receiver', '$sender', '$datetime', '$waybill_number', '$sender_address', '$order_number')";

// Menjalankan query untuk memasukkan data transaksi
if (mysqli_query($conn, $sql_transaction)) {
    // Mengambil ID transaksi yang baru saja dimasukkan
    $transaction_id = mysqli_insert_id($conn);

    // Memasukkan detail barang ke dalam database dan mengurangi stok
    foreach ($_POST['item_code'] as $key => $item_code) {
        $item_name = $_POST['item_name'][$key];
        $total_pcs = $_POST['total_pcs'][$key];
        $description = $_POST['description'][$key];
        $price = $_POST['Harga'][$key];
       
        
        // Menyiapkan query untuk memasukkan detail barang ke dalam database
        $sql_items = "INSERT INTO transaction_items (transaction_id, item_code, item_name, total_pcs, description, waybill_number, price) 
                      VALUES ('$transaction_id', '$item_code', '$item_name', '$total_pcs', '$description', '$waybill_number', '$price')";

        // Menjalankan query untuk memasukkan detail barang
        if (!mysqli_query($conn, $sql_items)) {
            // Menampilkan pesan kesalahan jika terjadi kesalahan saat memasukkan detail barang
            echo "Error: " . $sql_items . "<br>" . mysqli_error($conn);
            exit;
        }

        // Menyiapkan query untuk mengurangi stok barang
        // Menyiapkan query untuk mengurangi stok barang
$sql_update_stock = "UPDATE items SET stock = stock - $total_pcs WHERE id = '$item_code'";


        // Menjalankan query untuk mengurangi stok barang
        if (!mysqli_query($conn, $sql_update_stock)) {
            // Menampilkan pesan kesalahan jika terjadi kesalahan saat mengurangi stok barang
            echo "Error: " . $sql_update_stock . "<br>" . mysqli_error($conn);
            exit;
        }
    }

    // Mengarahkan pengguna ke halaman sukses atau halaman lain yang sesuai
    header("Location: ../Transaction/TransactionList.php");
    exit;
} else {
    // Menampilkan pesan kesalahan jika terjadi kesalahan saat memasukkan data transaksi
    echo "Error: " . $sql_transaction . "<br>" . mysqli_error($conn);
}
    }else{
        $_SESSION['No_Permission'] = "You do not have permission to perform this action.";
        header("Location: ../Transaction/CreateTransaction.php");
        
    }
      
    
}


// Menutup koneksi ke database
mysqli_close($conn);

// Fungsi untuk menghasilkan nomor waybill secara acak
function generateWaybillNumber() {
    // Ambil timestamp saat ini dan tambahkan angka acak untuk membuat nomor waybill unik
    $randomNumber = mt_rand(00, 99); // Ubah sesuai dengan rentang yang diinginkan
    $waybillNumber = "WB" . time() . $randomNumber; // Gunakan timestamp saat ini sebagai bagian dari nomor waybill
    return $waybillNumber;
}
?>
