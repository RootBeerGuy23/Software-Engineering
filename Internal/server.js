const express = require('express');
const app = express();
const fs = require('fs');
const ping = require('ping');
const path = require('path');
const moment = require('moment-timezone');
const mysql = require('mysql');

require('dotenv').config({ path: '../Auth/.env' });

const konfigurasi = {
  host: process.env.DB_SERVER,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE,
  port: 3306
};

// Koneksi database
const connection = mysql.createConnection(konfigurasi);

// Array yang mendefinisikan daftar server yang ingin di-ping
const servers = [
  { name: 'Database SQL', host: 'localhost' },
  { name: 'SpehereINC Web Service', host: 'localhost' },
  // Tambahkan server lain jika diperlukan
];


// Fungsi untuk menyimpan data ping ke database
function savePingDataToDatabase(pingResults) {
  const currentTime = moment().tz('Asia/Jakarta').format('YYYY-MM-DD HH:mm:ss');
  const values = pingResults.map(server => [
    server.serverName,
    server.host,
    server.isAlive ? 1 : 0,
    server.pingTime !== null ? server.pingTime : null,
    server.lastPing !== null ? server.lastPing : null,
    currentTime
  ]);

  const query = `
    INSERT INTO status (ServerName, Host, IsAlive, PingTime, LastPing, Timestamp)
    VALUES ?
  `;

  connection.query(query, [values], (error, results) => {
    if (error) {
      console.error('Error saving data to database:', error);
    } else {
      console.log('Data saved to database successfully');
    }
  });
}

async function updatePingData() {
  const pingResults = [];

  for (const server of servers) {
    try {
      const result = await ping.promise.probe(server.host);
      const currentTime = moment().toISOString();
      const lastPingTime = server.pingTime !== null ? server.pingTime : null;
      const currentPingTime = result.alive ? result.time : null;

      pingResults.push({
        serverName: server.name,
        host: server.host,
        isAlive: result.alive,
        pingTime: currentPingTime, // Menggunakan waktu ping saat ini
        lastPing: lastPingTime, // Menggunakan waktu ping terakhir
        timestamp: currentTime,
      });

      // Update server status dan waktu ping terakhir
      server.isAlive = result.alive;
      server.pingTime = currentPingTime; // Perbarui waktu ping terakhir
    } catch (error) {
      console.error(`Ping error for ${server.host}: ${error.message}`);
    }
  }

  savePingDataToDatabase(pingResults);

  const filePath = path.join(__dirname, '..', 'Assets', 'api', 'servers', 'PingResult.json');
  fs.writeFile(filePath, JSON.stringify(pingResults, null, 2), err => {
    if (err) {
      console.error(err);
    } else {
      console.log('Data JSON updated successfully');
    }
  });
}

async function shutdown() {
  const currentTime = moment().toISOString();
  const pingResults = servers.map(server => ({
    serverName: server.name,
    host: server.host,
    isAlive: false,
    pingTime: null,
    lastPing: server.pingTime !== null ? server.pingTime : null, // Perbaiki di sini
    timestamp: currentTime,
  }));

  
  const filePath = path.join(__dirname, '..', 'Assets', 'api', 'servers', 'PingResult.json');

    fs.writeFileSync(filePath, JSON.stringify(pingResults, null, 2));
  console.log('Data JSON updated on server shutdown');

  try {
    savePingDataToDatabase(pingResults);
    connection.end(); // Tutup koneksi setelah selesai
    process.exit(); // Keluar dari proses Node.js
  } catch (error) {
    console.error('Error saving data to database:', error);
    process.exit(1); // Keluar dari proses Node.js dengan kode error
  }
}

process.on('SIGINT', shutdown);
process.on('SIGTERM', shutdown);

// API endpoint untuk mendapatkan data ping
app.get('../Assets/api/servers', (req, res) => {
    const filePath = path.join(__dirname, '..', 'Assets', 'api', 'servers', 'PingResult.json');
  fs.readFile(filePath, 'utf8', (err, data) => {
    if (err) {
      console.error(err);
      res.status(500).json({ error: 'Internal server error' });
      return;
    }
    
    try {
      const pingResults = JSON.parse(data);
      res.json(pingResults);
    } catch (err) {
      console.error(err);
      res.status(500).json({ error: 'Internal server error' });
    }
  });
});

// Rute untuk menyajikan file statis
app.use(express.static(path.join(__dirname, 'status')));

// Interval untuk memperbarui data ping secara berkala (misalnya setiap 5 detik)
setInterval(() => {
  updatePingData();
}, 5000);

// Server listening on port 8080
app.listen(8080, () => {
  console.log('Server listening on port 8080');
});

// Panggil fungsi updatePingData untuk menjalankan proses update dan insert data saat aplikasi berjalan
updatePingData();
