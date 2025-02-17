<?php
session_start();
require 'kapcsolat.php'; // Az adatbázis kapcsolatot biztosító fájl

// Csak bejelentkezett felhasználóknak
if (!isset($_SESSION['uid'])) {
    echo json_encode(['success' => false, 'message' => 'Jelentkezz be először!']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$bookId = $data['bookId'];
$action = $data['action'];
$uid = $_SESSION['uid'];

// Lekérdezzük, hogy a könyv már szerepel-e a kosárban
$query = "SELECT * FROM kosar WHERE uid = ? AND kgid = ?";
$stmt = mysqli_prepare($adb, $query);
mysqli_stmt_bind_param($stmt, "is", $uid, $bookId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($action == 'add') {
    if (mysqli_num_rows($result) == 0) {
        // Ha nem szerepel, hozzáadjuk a kosárhoz
        $query = "INSERT INTO kosar (uid, kgid) VALUES (?, ?)";
        $stmt = mysqli_prepare($adb, $query);
        mysqli_stmt_bind_param($stmt, "is", $uid, $bookId);
        mysqli_stmt_execute($stmt);
    }
} elseif ($action == 'remove') {
    if (mysqli_num_rows($result) > 0) {
        // Ha már szerepel, eltávolítjuk a kosárból
        $query = "DELETE FROM kosar WHERE uid = ? AND kgid = ?";
        $stmt = mysqli_prepare($adb, $query);
        mysqli_stmt_bind_param($stmt, "is", $uid, $bookId);
        mysqli_stmt_execute($stmt);
    }
}

echo json_encode(['success' => true]);
?>
