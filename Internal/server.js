const express = require('express');
const app = express();
const fs = require('fs');
const net = require('net');
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

let connection;

// Fungsi untuk membuat koneksi database
function createDbConnection() {
  connection = mysql.createConnection(konfigurasi);

  connection.connect(err => {
    if (err) {
      console.error('Error connecting to database:', err);
      setTimeout(createDbConnection, 2000); // Coba hubungkan kembali setelah 2 detik
    } else {
      console.log('Connected to database');
    }
  });

  connection.on('error', err => {
    console.error('Database error:', err);
    if (err.code === 'PROTOCOL_CONNECTION_LOST' || err.code === 'ECONNRESET') {
      createDbConnection(); // Coba hubungkan kembali jika koneksi terputus
    } else {
      throw err;
    }
  });
}

// Inisialisasi koneksi database
createDbConnection();

// Array yang mendefinisikan daftar server yang ingin di-ping
const servers = [
  { name: 'Database SQL', host: 'localhost', port: 3306, pingTime: null },
  { name: 'SpehereINC Web Service', host: 'localhost', port: 80, pingTime: null },
  // Tambahkan server lain jika diperlukan
];

// Fungsi untuk memeriksa port terbuka
function checkPortOpen(host, port) {
  return new Promise((resolve) => {
    const socket = new net.Socket();
    const timeout = 2000; // 2 detik timeout

    socket.setTimeout(timeout);
    socket.on('connect', () => {
      socket.destroy();
      resolve(true);
    }).on('timeout', () => {
      socket.destroy();
      resolve(false);
    }).on('error', () => {
      socket.destroy();
      resolve(false);
    }).connect(port, host);
  });
}

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
      const startTime = moment();
      const portOpen = await checkPortOpen(server.host, server.port);
      const endTime = moment();
      const currentPingTime = portOpen ? endTime.diff(startTime) : null;

      pingResults.push({
        serverName: server.name,
        host: server.host,
        isAlive: portOpen,
        pingTime: currentPingTime,
        lastPing: server.pingTime !== null ? server.pingTime : null,
        timestamp: endTime.toISOString(),
      });

      // Update server status dan waktu ping terakhir
      server.isAlive = portOpen;
      server.pingTime = currentPingTime;

      // Log status server
      console.log(`Server: ${server.name}, Host: ${server.host}, Port: ${server.port}, IsAlive: ${portOpen}, PingTime: ${currentPingTime}`);
    } catch (error) {
      console.error(`Ping error for ${server.host}:${server.port} - ${error.message}`);
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
    lastPing: server.pingTime !== null ? server.pingTime : null,
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
  updatePingData().catch(error => {
    console.error('Error during ping update:', error);
  });
}, 5000);

// Server listening on port 8080
app.listen(8080, () => {
  console.log('Server listening on port 8080');
});

// Panggil fungsi updatePingData untuk menjalankan proses update dan insert data saat aplikasi berjalan
updatePingData().catch(error => {
  console.error('Initial ping update error:', error);
});
