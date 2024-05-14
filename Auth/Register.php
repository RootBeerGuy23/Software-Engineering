<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pengguna</title>
</head>
<body>
    <h2>Registrasi Pengguna</h2>
    <?php 
     if(isset($_SESSION['error_message'])) {
        echo "<p style='color:red'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']); // Hapus pesan kesalahan setelah ditampilkan
    }

    // Tampilkan pesan sukses jika ada
    if(isset($_SESSION['success_message'])) {
        echo "<p style='color:green'>" . $_SESSION['success_message'] . "</p>";
        unset($_SESSION['success_message']); // Hapus pesan sukses setelah ditampilkan
    }
    ?>
    <form action="../Action/register_process.php" method="post">

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="name">Date Of Birth:</label><br>
        <input type="date" id="dob" name="dob"><br>

        <label for="name">NIK:</label><br>
        <input type="text" id="nik" name="nik" oninput="validateNIK(this);" maxlength="5" disabled><br>


    
        <label for="name">Department:</label><br>
        <select name="department" id="department">
            <option value="HR">HR</option>
            <option value="IT">IT</option>
            <option value="Finance">Finance</option>
            <option value="Marketing">Marketing</option>
        </select><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="password">Retype Password:</label><br>
        <input type="password" id="passwordRetype" name="passwordRetype"><br><br>

        <input type="submit" value="Registrasi">
    </form>
</body>
</html>



<script>
// function validateNIK(input) {
//     // Hapus karakter non-angka dari input
//     input.value = input.value.replace(/\D/g, '');

//     // Pastikan panjang input tepat 16 digit
//     if (input.value.length !== 5) {
//         input.setCustomValidity('NIK harus terdiri dari 16 digit angka.');
//     } else {
//         input.setCustomValidity('');
//     }
// }


function ValidatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("passwordRetype").value;
    if (password != confirmPassword) {
        alert("Passwords do not match.");
        // document.getElementById("passwordRetype").setCustomValidity("Passwords Don't Match");
    } else {
        document.getElementById("passwordRetype").setCustomValidity('');
    }
}

</script>



