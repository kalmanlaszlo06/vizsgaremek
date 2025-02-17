<?php
$adb = mysqli_connect("localhost", "root", "", "kl_registration");
if (!$adb) {
    die("Adatbázis hiba: " . mysqli_connect_error());
}


