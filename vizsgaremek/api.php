<?php
header('Content-Type: application/json; charset=utf-8');

$adb = mysqli_connect("localhost", "root", "", "kl_registration");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'hibás id']);
    exit; 
}

$id = mysqli_real_escape_string($adb, $_GET['id']);
$konyvek = mysqli_query($adb, "SELECT * FROM konyvek WHERE konyvid = '$id'");

if (!$konyvek) {
    echo json_encode(['error' => 'valami hiba történt']);
    exit;
}

$konyv = mysqli_fetch_array($konyvek, MYSQLI_ASSOC);

if (!$konyv) {
    echo json_encode(['error' => 'nincs ilyen könyv']);
    exit;
}

$tomb = array(
    'id'     => $konyv['konyvid'],
    'cim'    => $konyv['kcim'],
    'iro'    => $konyv['iro'],
    'borito' => $konyv['borito'],
    'oldal'  => $konyv['oldal'],
    'mufaj'  => $konyv['mufaj'],
    'kdatum'  => $konyv['kdatum'],
    'kiado'  => $konyv['kiado'],
    'leiras' => $konyv['leiras'],
);

$json = json_encode($tomb, JSON_UNESCAPED_UNICODE);
echo $json;
?>