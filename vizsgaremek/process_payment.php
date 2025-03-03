<?php
session_start();

if ($_POST['name'] == "") {
    die("<script> alert('Nem adtad meg a neved!') </script>");
}

if ($_POST['cardnumber'] == "") {
    die("<script> alert('Nem adtad meg az kártyaszámod!') </script>");
}

if ($_POST['expiry'] == "") {
    die("<script> alert('Nem adtad meg a lejárati dátumot!') </script>");
}

if ($_POST['cvv'] == "") {
    die("<script> alert('Nem adtad meg a cvv!') </script>");
}

include('kapcsolat.php');

$uid = $_SESSION['uid'];
$konyvek = mysqli_query($adb, "SELECT * FROM kosar WHERE uid = '$uid' AND statusz = 1");

if (mysqli_num_rows($konyvek) > 0) {
    while ($konyv = mysqli_fetch_array($konyvek, MYSQLI_ASSOC)) {
        $name = mysqli_real_escape_string($adb, $_POST['name']);
        $cardnumber = mysqli_real_escape_string($adb, $_POST['cardnumber']);
        $expiry = mysqli_real_escape_string($adb, $_POST['expiry']);
        $cvv = mysqli_real_escape_string($adb, $_POST['cvv']);
        $kid = mysqli_real_escape_string($adb, $konyv['kid']);
        $time = date('Y-m-d H:i:s');

        $query = "INSERT INTO `vasarlas`(`vid`, `koid`, `nev`, `cardnumber`, `ldatum`, `cvv`, `statusz`, `datum`) 
          VALUES (NULL, '$kid', '$name', '$cardnumber', '$expiry', '$cvv', 1, '$time')";

        if (!mysqli_query($adb, $query)) {
            die("Query failed: " . mysqli_error($adb));
        }

        $query1 = "UPDATE kosar SET `statusz`= 0 WHERE uid = ? AND koid = ? AND statusz = 1 LIMIT 1";  
        $stmt1 = mysqli_prepare($adb, $query1);
        mysqli_stmt_bind_param($stmt1, "is", $uid, $konyv['koid']);
        mysqli_stmt_execute($stmt1);
    }
    print "<script> alert('Sikeres vásárlás!') </script>";
    print "<script> parent.location.href = './?p=konyvek' </script>" ;
} else {
    die("<script> alert('Üres a kosár!') </script>");
}

?>