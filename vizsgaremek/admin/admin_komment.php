<?php
// Adatbázis kapcsolat
$adb = mysqli_connect("localhost", "root", "", "kl_registration");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $ukomment = $_POST['ukomment'];

    // Komment frissítése
    $query = "UPDATE user SET ukomment = ? WHERE uid = ?";
    $stmt = mysqli_prepare($adb, $query);
    mysqli_stmt_bind_param($stmt, "si", $ukomment, $uid);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Komment sikeresen hozzáadva.')</script>";
    } else {
        echo "<script>alert('Hiba történt a komment hozzáadásakor')</script>.";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($adb);
header("Location: ./?p=userek"); // Visszairányítás az admin oldalra
exit;
?>
