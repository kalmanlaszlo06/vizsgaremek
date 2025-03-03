<?php
// Adatbázis kapcsolat
include("../kapcsolat.php");

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
    <h1>Felhasználók listája</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Felhasználó név</th>
                <th>Email</th>
                <th>Regisztráció dátuma</th>
                <th>Állapot</th>
                <th>Komment hozzáadása</th>
                <th>Törlés</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                echo "<td><a href='../?p=adatlapom&id=" . urlencode($row['uid']) . "'>" . htmlspecialchars($row['username']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['uemail']) . "</td>";
                echo "<td>" . htmlspecialchars($row['udatum']) . "</td>";
                if ($row['ustatusz'] == 'a') {
                    echo "<td>Aktiv</td>";
                }elseif ($row['ustatusz'] == 'b') {
                    echo "<td>Admin</td>";
                }else {
                    echo "<td>Törölt</td>";
                }

                // Komment hozzáadása
                if (isset($row['ukomment']) ) {
                    echo "<td>
                        <form method='POST' action='admin_komment.php'>
                            <input type='hidden' name='uid' value='" . htmlspecialchars($row['uid']) . "'>
                            <input type='text' name='ukomment' placeholder='". htmlspecialchars($row['ukomment']) ."'>
                            <button type='submit'>Hozzáadás</button>
                        </form>
                    </td>";
                }else {
                    echo "<td>
                        <form method='POST' action='admin_komment.php'>
                            <input type='hidden' name='uid' value='" . htmlspecialchars($row['uid']) . "'>
                            <input type='text' name='ukomment' placeholder='Írj kommentet'>
                            <button type='submit'>Hozzáadás</button>
                        </form>
                    </td>";
                }
                // Felhasználó törlése
                echo "<td>
                    <form method='POST' action='admin_delete_user.php'>
                        <input type='hidden' name='uid' value='" . htmlspecialchars($row['uid']) . "'>
                        <button type='submit' onclick='return confirm(\"Biztosan törölni akarod?\")'>Törlés</button>
                    </form>
                </td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
