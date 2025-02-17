<?php
session_start();
include("../kapcsolat.php");

// Az admin válaszaihoz és új üzenetek lekérése
$query = "SELECT s.sszoveg, u.username, s.svalasz FROM support s
          LEFT JOIN user u ON s.uid = u.uid
          WHERE s.sstatusz = 'lezáratlan'
          ORDER BY s.sdatum DESC";

$result = mysqli_query($adb, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode(['messages' => $messages]);
?>
