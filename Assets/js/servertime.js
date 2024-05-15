function updateServerTime() {
    var serverTimeElement = document.getElementById('server-time');
    var currentTime = new Date(); // Mendapatkan waktu saat ini di sisi klien
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    
    // Tambahkan nol di depan angka jika kurang dari 10
    hours = (hours < 10 ? "0" : "") + hours;
    minutes = (minutes < 10 ? "0" : "") + minutes;
    seconds = (seconds < 10 ? "0" : "") + seconds;
    
    var serverTime = hours + ":" + minutes + ":" + seconds;
    
    serverTimeElement.textContent = "Server Time: " + serverTime;
}

// Memperbarui waktu setiap detik
setInterval(updateServerTime, 1000);

// Memanggil fungsi updateServerTime() untuk pertama kali saat halaman dimuat
updateServerTime();
