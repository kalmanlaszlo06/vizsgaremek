<?php
// Adatbázis kapcsolat
include("../kapcsolat.php");

// Felhasználói adatok lekérdezése
$query = "SELECT * FROM konyvek";
$result = mysqli_query($adb, $query);

if (!$result) {
    echo "Hiba történt az adatok lekérdezésekor.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ddd;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Könyvek</h1>
<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Könyv neve</th>
                <th>Író</th>
                <th>Kiadó</th>
                <th>Müfaj</th>
                <th>Ár</th>
                <th>Állapot</th>
                <th>Törlés</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['konyvid']) . "</td>";
                echo "<td><a href='../?p=konyvreszletek&id=" . urlencode($row['konyvid']) . "'>" . htmlspecialchars($row['kcim']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['iro']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kiado']) . "</td>";
                echo "<td>" . htmlspecialchars($row['mufaj']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ar']) . "</td>";
                if ($row['statusz'] == 'a') {
                    echo "<td>Aktiv</td>";
                }else {
                    echo "<td>Törölt</td>";
                }

                // Felhasználó törlése
                if ($row['statusz'] == 'a') {
                    echo "<td>
                    <form method='POST' action='admin_delete_konyvek.php'>
                        <input type='hidden' name='kid' value='" . htmlspecialchars($row['konyvid']) . "'>
                        <button type='submit' onclick='return confirm(\"Biztosan törölni akarod?\")'>Törlés</button>
                    </form>
                    </td>";
                }
                

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>