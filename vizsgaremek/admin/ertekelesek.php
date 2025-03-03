<?php
// Adatbázis kapcsolat
include("../kapcsolat.php");

if (!$adb) {
    die("Adatbázis kapcsolat sikertelen: " . mysqli_connect_error());
}

// Törlés művelet
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $eid = intval($_GET['delete']);
    $deleteQuery = "UPDATE ertekelesek SET status = 'b' WHERE eid = $eid";

    if (mysqli_query($adb, $deleteQuery)) {
        header("Location: ./?p=ertekelesek");
        exit();
    } else {
        echo "Hiba történt a törlés során: " . mysqli_error($adb);
    }
}

// Módosítás mentése
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $eid = intval($_POST['eid']);
    $eszoveg = mysqli_real_escape_string($adb, $_POST['eszoveg']);
    $updateQuery = "
        UPDATE ertekelesek 
        SET eszoveg = '$eszoveg', edatum = NOW() 
        WHERE eid = $eid";
    if (mysqli_query($adb, $updateQuery)) {
        header("Location: ./?p=ertekelesek");
        exit();
    } else {
        echo "Hiba történt a módosítás során: " . mysqli_error($adb);
    }
}

// Értékelések lekérdezése
$query = "
    SELECT `eid`, `kid`, `eszoveg`,
     `edatum`, `status` , `username` , `uemail` 
    FROM `ertekelesek` 
    INNER JOIN user ON ertekelesek.uid = user.uid
    ORDER BY edatum DESC
";

$result = mysqli_query($adb, $query);

if (!$result) {
    die("Hiba történt az értékelések lekérdezésekor: " . mysqli_error($adb));
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Értékelések</title>
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
            text-align: left;
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
        button {
            padding: 6px 12px;
            margin: 0 2px;
            border: none;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #DC3545;
        }
        .delete-button:hover {
            background-color: #A71D2A;
        }
    </style>
</head>
<body>
    <h1>Felhasználói Értékelések</h1>
    <table>
        <thead>
            <tr>
                <th>Értékelés ID</th>
                <th>Könyv ID</th>
                <th>Felhasználó</th>
                <th>Email</th>
                <th>Szöveg</th>
                <th>Dátum</th>
                <th>Állapot</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['eid']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kid']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['uemail']) . "</td>";
                echo "<td>" . htmlspecialchars($row['eszoveg']) . "</td>";
                echo "<td>" . htmlspecialchars($row['edatum']) . "</td>";
                echo "<td>"; 
                if ($row['status'] == 'a') {
                    echo 'aktiv';
                }else{
                    echo 'törölt';
                }
                echo "</td>";
                echo "<td>";
                echo "<form method='POST' style='display:inline;'>
                        <input type='hidden' name='eid' value='" . htmlspecialchars($row['eid']) . "'>
                        <input type='text' name='eszoveg' value='" . htmlspecialchars($row['eszoveg']) . "' required>
                        <button type='submit' name='update'>Módosítás</button>
                      </form>";
                echo "<a href='./?p=ertekelesek&delete=" . htmlspecialchars($row['eid']) . "'>
                        <button class='delete-button'>Törlés</button>
                      </a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
mysqli_close($adb);
?>
