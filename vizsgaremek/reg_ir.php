<?php
if($_POST['username']=="" )
    die("<script> alert('Nem adtad meg a felhasználóneved!') </script>");

if($_POST['email']=="" )
    die("<script> alert('Nem adtad meg az email címed!') </script>");

if($_POST['password']=="" )
    die("<script> alert('Nem adtad meg a jelszavad!') </script>");
if ($_POST['checkbox']==false) {
    die("<script> alert('Nem fogadtad el a feltételeket!') </script>");
}
include("kapcsolat.php");
$upw = md5($_POST['password']);
mysqli_query($adb , "
INSERT INTO user ( uid, username, uemail, upassword, uszuldatum, udatum, uip, usession, ustatusz, ukomment, ufirstname, ulastname) 
VALUES           (NULL, '$_POST[username]', '$_POST[email]', '$upw', '',  NOW(),  '',  '', 'a', '',  '',  '')
");
mysqli_close($adb);
print "<script> alert('sikeres regisztárás')</script>";
print "<script> parent.location.href = './?p=login' </script>";
?>