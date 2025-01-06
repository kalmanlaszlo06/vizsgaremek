<?php
session_start();
include("kapcsolat.php");
$pw = md5($_POST["pw"]);
$regijelszo = mysqli_fetch_array(mysqli_query($adb,"SELECT * FROM user WHERE uid ='$_SESSION[uid]'"));
if($_POST['pw']=="") die("<script> alert('Jelszó?')  </script>");
if($_POST['pw2']=="") die("<script> alert('Jelszó?')  </script>");
if($_POST['pw']!=$regijelszo["password"]) die("<script> alert('nem egyezik a régi jelszó')  </script>");

mysqli_query($adb , " UPDATE user SET password = '$_POST[pw2]' WHERE uid='$_POST[uid]'");
print"<script>alert('Jelszavát sikeresen módosíottuk')</script>";

$pw = md5($_POST["pw1"]);
$jelszo = mysqli_fetch_array(mysqli_query($adb,"SELECT * FROM user WHERE uid = '$_SESSION[uid]'"));
if ($pw!==$jelszo['upw']) {
    die("<script>alert('a régi jelszó nem egyezik')</script>");
}
$pw2 = md5($_POST["pw2"]);
mysqli_query($adb, "UPDATE user SET upw ='$pw2' WHERE uid = '$_SESSION[uid]'");
print("<script>alert('siker')</script>");
mysqli_close($adb);

?>