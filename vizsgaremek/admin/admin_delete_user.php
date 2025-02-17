<?php
// Adatbázis kapcsolat
$adb = mysqli_connect("localhost", "root", "", "kl_registration");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];

    // Felhasználó törlése
    $query = "DELETE FROM user WHERE uid = ?";
    $stmt = mysqli_prepare($adb, $query);
    mysqli_stmt_bind_param($stmt, "i", $uid);

    if (mysqli_stmt_execute($stmt)) {
        echo "Felhasználó sikeresen törölve.";
    } else {
        echo "Hiba történt a felhasználó törlésekor.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($adb);
header("Location: ./?p=userek"); // Visszairányítás az admin oldalra
exit;
?>
