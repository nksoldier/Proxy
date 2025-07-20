<?php

$api_url = 'https://pooriyaesmaeelzade.ir/api/proxy/';
$response = file_get_contents($api_url);
$data = json_decode($response, true);

usort($data['proxies'], function ($a, $b) {
  return $a['ping'] <=> $b['ping'];
});

$numbers = ["1", "2", "3"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Proxy List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef3f9;
      padding: 40px;
      color: #333;
      text-align: center;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    }

    h1 {
      color: #007BFF;
      text-align: center;
    }

    .proxy {
      background: #f5faff;
      border: 1px solid #d6e9ff;
      border-left: 5px solid #007BFF;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      text-align: left;
    }

    .proxy h2 {
      margin: 0 0 5px;
      font-size: 18px;
    }

    .proxy p {
      margin: 4px 0;
    }

    .copy-btn {
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    .copy-btn:hover {
      background-color: #0056b3;
    }

    .docs-button {
      display: inline-block;
      margin-top: 40px;
      padding: 12px 28px;
      background-color: #007BFF;
      color: white;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .docs-button:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Available Proxies</h1>
    <div id="proxy-list">
      <?php foreach ($data['proxies'] as $index => $proxy): ?>
        <div class="proxy">
          <h2>Number: <?= $numbers[$index] ?? ($index + 1) ?></h2>
          <p>
            Host:
            <code id="host-<?= htmlspecialchars($proxy['name']) ?>"><?= htmlspecialchars($proxy['host']) ?></code>
            <button class="copy-btn" onclick="copyToClipboard('host-<?= htmlspecialchars($proxy['name']) ?>', this)">Copy</button>
          </p>
          <p>Ping: <?= htmlspecialchars($proxy['ping']) ?> ms</p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <a href="docs.html" class="docs-button">Docs</a>

  <script>
    function copyToClipboard(id, btn) {
      const text = document.getElementById(id).textContent;
      navigator.clipboard.writeText(text).then(() => {
        btn.textContent = "Copied!";
        btn.style.backgroundColor = "#28a745";
        setTimeout(() => {
          btn.textContent = "Copy";
          btn.style.backgroundColor = "#007BFF";
        }, 1500);
      });
    }
  </script>
</body>

</html>
