<?php
session_start();

print_r($_POST);

print"<hr>";

print_r($_FILES);

include("kapcsolat.php");
function randomstring($h)
{
    $c = '1234567890qwertzuiopasdfghjklyxcvbnm';
    $s = "";
    for ($i = 0; $i < $h; $i++) {
        $s .= substr($c, rand(0, strlen($c) - 1), 1);
    }
    return $s; 
}
$kepnev = $_SESSION['uid'] . "_" . date("ymdHis") ."_". randomstring(10);

$kepadat = $_FILES['profkep'];
if($kepadat['type'] == "image/jpeg") $kiterj = ".jpg"; else
if($kepadat['type'] == "image/png") $kiterj = ".png"; else
if($kepadat['type'] == "image/jpeg") $kiterj = ".jfif"; else
die("<script>alert('A kép csak .JPG, vagy .PNG fájl lehet!') </script>");

$kepnev .= $kiterj;

move_uploaded_file($kepadat['tmp_name'],"./profilkepek/",$kepnev);

$eredetikepnev = $kepadat['name'];

print "<br>" . $kepnev;

if($_POST['username']=="") die("<script> alert('Nick név?')  </script>");

mysqli_query($adb , "
UPDATE user 
SET uemail     = '$_POST[email]' ,
    username   = '$_POST[username]',
    uszuldatum = '$_POST[szuldatum]',
    ufirstname = '$_POST[keresztnev]',
    ulastname  = '$_POST[vezeteknev]',
    uprofkepnev = '$kepnev',
    uprofkepnev_eredetinev = '$eredetikepnev'


WHERE uid='$_POST[uid]'
");

$_SESSION['username'] = $_POST['username'];

print"
    <script>
    alert('Adatait sikeresen módosíottuk')
    </script>
";

mysqli_close($adb);

?>