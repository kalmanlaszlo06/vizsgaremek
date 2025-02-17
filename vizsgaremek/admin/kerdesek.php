<?php
session_start();
include("../kapcsolat.php");

// Ellenőrizzük, hogy az admin be van-e jelentkezve (opcionális ellenőrzés).

// A kérdések betöltése az adatbázisból
$query = "SELECT s.supportid, s.uid, u.username, s.sszoveg, s.sstatusz, s.svalasz 
          FROM support s 
          LEFT JOIN user u ON s.uid = u.uid 
          ORDER BY s.sdatum DESC";

$result = mysqli_query($adb, $query);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kérdések</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: lightgray;
        }
        textarea {
            width: 100%;
            height: 50px;
        }
        .action-buttons {
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn.delete {
            background-color: #f44336;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Felhasználói kérdések kezelése</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Felhasználó</th>
                <th>Kérdés</th>
                <th>Állapot</th>
                <th>Válasz</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['supportid'] ?></td>
                    <td><?= htmlspecialchars($row['username'] ?? 'Ismeretlen') ?></td>
                    <td><?= htmlspecialchars($row['sszoveg']) ?></td>
                    <td><?= htmlspecialchars($row['sstatusz']) ?></td>
                    <td>
                        <textarea data-supportid="<?= $row['supportid'] ?>"><?= htmlspecialchars($row['svalasz'] ?? '') ?></textarea>
                    </td>
                    <td class="action-buttons">
                        <button class="btn save" onclick="saveResponse(<?= $row['supportid'] ?>)">Mentés</button>
                        <button class="btn delete" onclick="deleteQuestion(<?= $row['supportid'] ?>)">Törlés</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
        function saveResponse(supportId) {
    const textarea = document.querySelector(`textarea[data-supportid='${supportId}']`);
    const response = textarea.value;

    fetch('../support_admin_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'save', supportid: supportId, svalasz: response })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hiba történt a szerverrel való kapcsolatban.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Válasz mentve!');
        } else {
            alert('Hiba történt a mentés során: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Hiba a mentés során:', err);
        alert('Nem sikerült a mentés, próbálja meg később.');
    });
}

function deleteQuestion(supportId) {
    if (!confirm('Biztosan törölni szeretné ezt a kérdést?')) return;

    fetch('../support_admin_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'delete', supportid: supportId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hiba történt a szerverrel való kapcsolatban.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Kérdés törölve!');
            location.reload();
        } else {
            alert('Hiba történt a törlés során: ' + data.message);
        }
    })
 
}

    function fetchAdminMessages() {
        fetch('fetch_admin_messages.php')
            .then(response => response.json())
            .then(data => {
                const messageContainer = document.getElementById('adminMessages');
                messageContainer.innerHTML = ''; // Az eddigi üzenetek törlése
                data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'admin-message';
                    messageElement.textContent = message.sszoveg + ' - ' + message.username;
                    messageContainer.appendChild(messageElement);
                });
            })
            .catch(err => console.error('Hiba történt az admin üzenetek lekérésekor:', err));
    }

    // Polling az admin üzenetekre (5 másodpercenként)
    setInterval(fetchAdminMessages, 5000);
    </script>
</body>
</html>

