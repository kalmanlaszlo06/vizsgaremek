<?php
session_start();
include('kapcsolat.php');
function grs($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*$pw = md5($_POST["pw"]);
$jelszo = mysqli_fetch_array(mysqli_query($adb,"SELECT * FROM user WHERE uid = '$_POST[uid]'"));*/
if ($_POST['username']=='') {
    die("<script>alert('Nem megfelelő a felhasználó nevedet!')</script>");
}
if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    die("<script>alert('Nem megfelelő email-cím!')</script>");
}
/*if ($_POST['pw']=='') {
    die("<script>alert('jelszó kell a modositáshoz')</script>");
}
if ($pw!==$jelszo['upw']) {
    die("<script>alert('a jelszó nem egyezik')</script>");
}*/
if (!empty($_FILES["profkep"])) { //miért megy bele mindig?
    $kepnev = $_SESSION["uid"]."_".date("ymdHis")."_". grs(10) ;
    $kepadat = $_FILES["profkep"]; 
    if ($kepadat["type"]=="image/jpeg") $kiterj = ".jpg"; else
    if ($kepadat["type"]=="image/png") $kiterj = ".png"; else die("<script>alert('png vagy jpg legyen a kép kiterjesztése')</script>");
    $kepnev .= $kiterj;
    move_uploaded_file($kepadat["tmp_name"], "./profilkepek/".$kepnev);
    $eredetikepnev = $kepadat["name"];
    mysqli_query($adb, "UPDATE user SET uemail = '$_POST[email]', username = '$_POST[username]', uprofkepnev ='$kepnev', uprofkepnev_eredetinev='$eredetikepnev' WHERE uid = '$_POST[uid]'");
}else{
    mysqli_query($adb, "UPDATE user SET uemail = '$_POST[email]', username = '$_POST[username]' WHERE uid = '$_POST[uid]'");
}
$_SESSION['unick']=$_POST['user'];
print"<script>alert('Módositotuk adatait') </script>";
print"<script>parent.location.href=parent.location.href</script>";
mysqli_close($adb);
?>