<?php
session_start();
require_once 'kapcsolat.php';

if (!isset($_SESSION['uid'])) {
    echo json_encode(['success' => false, 'message' => 'Jelentkezz be először!']);
    exit;
}

$uid = $_SESSION['uid'];
$data = json_decode(file_get_contents("php://input"), true);
$bookId = $data['id'] ?? null;

if (!$bookId) {
    echo json_encode(['success' => false, 'message' => 'Hibás könyvazonosító.']);
    exit;
}

$query = "DELETE FROM kosar WHERE uid = ? AND kgid = ?";
$stmt = mysqli_prepare($adb, $query);
mysqli_stmt_bind_param($stmt, "is", $uid, $bookId);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'A könyv nem található.']);
}
exit;
?>
