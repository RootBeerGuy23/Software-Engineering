<!DOCTYPE html>
<html>

<head>
  <title>Server Status Dashboard</title>
  <link rel="stylesheet" href="../Assets/css/Internal.css">
  <link rel="icon" href="../Assets/img/logo.png">
  
  
  
</head>

<body>
  
  <div class="wave-container">
    <div class="wave"></div>
  </div>

  <div class="navbar">
    <h1>SphereINC Server Status</h1>
    <img src="../Assets/img/logo.png" alt="Logo">
  </div>
  <div id="clock"></div>

<div class="running-text">
    <p>
      Welcome to SphereINC Server Status Dashboard. This page will automatically update every 2 seconds to show the latest server status.

    </p>
    
  </div>



  <div class="container" id="status-container"></div>

  <div class="footer">
    <p>&copy; StoreSpehere INC</p>
  </div>

  <script>
    // Fetch data and update UI
    
    function fetchData() {
      fetch('../Assets/api/servers/PingResult.json')
        .then(response => response.json())
        .then(data => {
          const statusContainer = document.getElementById('status-container');
          statusContainer.innerHTML = '';

          data.forEach(server => {
            const serverDiv = document.createElement('div');
            serverDiv.classList.add('status-card');
            if (server.isAlive) {
              serverDiv.classList.add('up');
              const pingTime = server.pingTime ? `${server.pingTime} ms` : 'Unknown';
              const timestamp = new Date(server.timestamp).toLocaleString();
              serverDiv.innerHTML = `
                <div class="server-name">${server.serverName}</div>
    
                <div class="ping-status">Server Status: Online<br>Ping Time: ${pingTime}<br>Last Update: ${timestamp}</div>
              `;
            } else {
              serverDiv.classList.add('down');
              const lastPingTime = server.lastPing;
              const lastUpdate = new Date(server.timestamp).toLocaleString();
              serverDiv.innerHTML = `
                <div class="server-name">${server.serverName}</div>
                <div class="ping-status">Server Status:  Down<br>Last Ping: ${lastPingTime} ms<br>Last Update: ${lastUpdate}</div>
              `;
            }

            statusContainer.appendChild(serverDiv);
          });
        })
        .catch(error => {
          console.error(error);
        });
    }

    // Initial data fetch
    fetchData();

    // Fetch data every 2 seconds
    setInterval(fetchData, 1000);
  </script>
</body>

</html>
