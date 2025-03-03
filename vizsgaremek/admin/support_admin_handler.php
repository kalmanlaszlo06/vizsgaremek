<?php
session_start();
include("../kapcsolat.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['szoveg'];
    if (!$input) {
        echo "<script>alert('Nem lehet üres a üzeneted!')</script>";
    }else {
        $id = $_POST['id'];
        $time = date("Y-m-d h:i:s");
        var_dump($time, $id, $input);
        $svalasz = mysqli_real_escape_string($adb, $input);
        $query = "UPDATE support SET svalasz = '$svalasz', sstatusz = 0, slezar = '$time' WHERE supportid = '$id'";
        if (mysqli_query($adb, $query)) {
            echo "<script>alert('Sikeres üzenet küldés')</script>";
        } else {
            print "fg";
            echo "<script>alert('Sikertelen üzenet küldés')</script>";
        }
        echo "<script>parent.location.href=parent.location.href</script>";
    }
}
?>
