<?php
// Adatbázis kapcsolat
$adb = mysqli_connect( "localhost", "root", "", "kl_registration" );

// Felhasználói adatok lekérdezése
$query = "SELECT * FROM user";
$result = mysqli_query($adb, $query);

if (!$result) {
    echo "Hiba történt az adatok lekérdezésekor.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók</title>
    <style>
        /* Táblázat stílus */
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
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Felhasználók listája</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Regisztráció dátuma</th>
                <th>Születési dátum</th>
                <th>Vezetéknév</th>
                <th>Keresztnév</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Felhasználók adatainak kiírása
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                // Link a felhasználó adatlapjára
                echo "<td><a href='adatlap_form1.php?uid=" . urlencode($row['uid']) . "'>" . htmlspecialchars($row['username']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['uemail']) . "</td>";
                echo "<td>" . htmlspecialchars($row['udatum']) . "</td>";
                echo "<td>" . htmlspecialchars($row['uszuldatum']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ufirstname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ulastname']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
