<?php
session_start();
include_once '../Auth/conn.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['NIK'])) {
    header("location: ../Auth/MainCheck");
    exit;
}

// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $receiver = $_POST['receiver'];
    $sender = $_POST['sender'];
    $datetime = $_POST['datetime'];
    $waybill_number = generateWaybillNumber(); // Menghasilkan nomor waybill secara acak
    $sender_address = $_POST['sender_address'];
    $order_number = $waybill_number;
   

    // Menyiapkan query untuk memasukkan data transaksi ke dalam database
    $sql_transaction = "INSERT INTO transactions (receiver, sender, datetime, waybill_number, sender_address, order_number) 
                        VALUES ('$receiver', '$sender', '$datetime', '$waybill_number', '$sender_address', '$order_number')";

    // Menjalankan query
    if (mysqli_query($conn, $sql_transaction)) {
        // Mengambil ID transaksi yang baru saja dimasukkan
        $transaction_id = mysqli_insert_id($conn);

        // Memasukkan detail barang ke dalam database
        foreach ($_POST['item_code'] as $key => $item_code) {
            $item_name = $_POST['item_name'][$key];
            $total_pcs = $_POST['total_pcs'][$key];
            $description = $_POST['description'][$key];
            $price = $_POST['Harga'][$key];

            // Menyiapkan query untuk memasukkan detail barang ke dalam database
            $sql_items = "INSERT INTO transaction_items (transaction_id, item_code, item_name, total_pcs, description, waybill_number, price) 
                          VALUES ('$transaction_id', '$item_code', '$item_name', '$total_pcs', '$description', '$waybill_number', '$price')";

            // Menjalankan query
            if (!mysqli_query($conn, $sql_items)) {
                // Jika terjadi kesalahan saat memasukkan data detail barang ke database, hentikan proses dan tampilkan pesan kesalahan
                echo "Error: " . $sql_items . "<br>" . mysqli_error($conn);
                exit;
            }
        }

        // Redirect ke halaman sukses atau halaman lain yang sesuai
        header("Location: ../Transaction/TransactionList.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat memasukkan data transaksi ke database, tampilkan pesan kesalahan
        echo "Error: " . $sql_transaction . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi ke database
mysqli_close($conn);

// Fungsi untuk menghasilkan nomor waybill secara acak
function generateWaybillNumber() {
    // Ambil timestamp saat ini dan tambahkan angka acak untuk membuat nomor waybill unik
    $randomNumber = mt_rand(100000, 999999); // Ubah sesuai dengan rentang yang diinginkan
    $waybillNumber = "WB" . time() . $randomNumber; // Gunakan timestamp saat ini sebagai bagian dari nomor waybill
    return $waybillNumber;
}
?>
