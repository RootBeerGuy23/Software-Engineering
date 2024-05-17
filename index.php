<?php
session_start();
include_once 'Auth/conn.php';

// Memeriksa apakah pengguna sudah login
if(!isset($_SESSION['NIK'])){
    $_SESSION['No_Login'] = "No Login Session Found, Please Login First!";
    header("location: Auth/MainCheck");
    exit;
}
$NIK = $_SESSION['NIK'];

// Query untuk mengambil nama pengguna berdasarkan NIK
$sql = "SELECT username FROM users WHERE NIK='$NIK'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    // Tampilkan nama pengguna
    // echo "Halo, $username!";
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Spehere INC</title>
    <link rel="icon" href="Assets/img/logo.png">
    <link rel="stylesheet" href="Assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="Assets/js/servertime.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
            <a href="index">
                <img src="Assets/img/logo.png" alt="Link Logo">
            </a>
            </div>
            
            <div class="menu">
                <a href="index" id="biruin" >Dashboard</a>
                <a href="#contact">Contact</a>
                <a href="#services">Services</a>
                <a href="#about">About</a>  
                <li id="gabisadiclick"><i class="fa-solid fa-user"></i> <?php echo 'Hai, ' . $username?><a href="Auth/Logout" id="logoutLink"><i class="fa-solid fa-right-from-bracket"></i><br></a><h4 id="server-time"></h4></li>
                
            </div>
        </nav>
    </header>
    <section>
        <div class="rapi">
        <h2>List Warehouse </h2>
        <div class="warehouses">
        <?php 
            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Array untuk menyimpan nama tabel gudang
            $warehouses = array("CHINA", "JAKARTA", "BATAM", "BOGOR");

            // Array untuk menyimpan div yang akan dihasilkan
            $divs = array();

            // Loop untuk menampilkan data dari setiap tabel gudang
            foreach ($warehouses as $warehouse) {
                // Gunakan nama gudang sebagai bagian dari class div
                $class_name = strtolower($warehouse);
                $content = "<div class='warehouse $class_name'>";
                $content .= "<h2>Warehouse $warehouse</h2>";
                $sql = "SELECT id_barang, nama_barang, jumlah_stok, last_audit, last_update, description FROM warehouse_$warehouse";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $content .= "<table>";
                    $content .= "<tr><th>ID Barang</th><th>Nama Barang</th><th>Jumlah Stok</th><th>Last Audit</th><th>Last Update</th><th>Description</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        $content .= "<tr><td>".$row["id_barang"]."</td><td>".$row["nama_barang"]."</td><td>".$row["jumlah_stok"]."</td><td>".$row["last_audit"]."</td><td>".$row["last_update"]."</td><td>".$row["description"]."</td></tr>";
                    }
                    $content .= "</table>";
                } else {
                    $content .= "Tidak ada data di Warehouse $warehouse";
                }
                $content .= "</div><br>";
                $divs[] = $content; // Tambahkan konten div ke array
            }

            $conn->close();

            // Tampilkan semua div
            foreach ($divs as $div) {
                echo $div;
            }
            ?>

        </div> 
     </div>
    </section>
    <footer>
        <li>Terms & Conditions</li>
        <li>Accessibility</li>
        <li>FAQ</li>
        <li>Cookies Policy</li>
    </footer>
</body>
</html>


<script>
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault();
        var confirmLogout = confirm('Yakin mau logout?');
        if (confirmLogout) {
            window.location.href = 'Auth/Logout';
        }
    });
</script>