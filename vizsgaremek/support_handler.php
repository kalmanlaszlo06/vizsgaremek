<?php
session_start();
include("kapcsolat.php");

header('Content-Type: application/json');

// Ellenőrizni, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['uid'])) {
    echo json_encode(['success' => false, 'message' => 'Be kell jelentkezni az üzenetküldéshez.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['sszoveg']) || trim($input['sszoveg']) === '') {
    echo json_encode(['success' => false, 'message' => 'Az üzenet nem lehet üres.']);
    exit;
}

$uid = $_SESSION['uid'];
$sszoveg = mysqli_real_escape_string($adb, $input['sszoveg']);

// Üzenet mentése az adatbázisba
$query = "INSERT INTO support (uid, sszoveg, sstatusz) VALUES ('$uid', '$sszoveg', 'lezáratlan')";
if (mysqli_query($adb, $query)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Hiba történt az üzenet mentésekor.']);
}
?>
