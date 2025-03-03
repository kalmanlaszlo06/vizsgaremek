<?php
session_start();
include("../kapcsolat.php");

// Ellenőrizzük, hogy az admin be van-e jelentkezve (opcionális ellenőrzés).

// A kérdések betöltése az adatbázisból
$query = "SELECT s.supportid, s.uid, u.username, s.sszoveg, s.sstatusz, s.svalasz 
          FROM support s 
          LEFT JOIN user u ON s.uid = u.uid 
          WHERE s.stat = 1
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
                <th>Törlés</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['supportid'] ?></td>
                    <td><?= htmlspecialchars($row['username'] ?? 'Ismeretlen') ?></td>
                    <td><?= htmlspecialchars($row['sszoveg']) ?></td>
                    <td><?php if ($row['sstatusz'] == 1) {
                        echo "Aktiv";
                    }else {
                        echo "Lezárt";
                    }?>
                    </td>
                    <td>
                        <form action="support_admin_handler.php" target="kisablak" method="post">
                            <textarea id="szoveg"  name="szoveg"><?= htmlspecialchars(trim($row['svalasz'] ?? ''," "));?></textarea>
                            <input type="hidden" name="id" value="<?= $row['supportid'] ?>">
                            <?php if ($row['sstatusz'] == 1) {
                                echo '<input type="submit" value="Mentés">';
                            } ?>
                        </form>
                    </td>
                    <td class="action-buttons">
                        <form action="admin_support_delete.php" target="kisablak" method="post">
                            <input type="hidden" name="id" value="<?= $row['supportid'] ?>">
                            <input type="submit" value="Törlés">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

