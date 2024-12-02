<?php
session_start();

print_r($_POST);

include("kapcsolat.php");

if($_POST['ujjelszo']=="") die("<script> alert('Jelszó?')  </script>");
$regijelszo = mysqli_fetch_array(mysqli_query($adb,"SELECT password FROM user WHERE uid ='$_SESSION[uid]'"));
    mysqli_query($adb , "
    UPDATE user 
    SET password = '$_POST[ujjelszo2]'
    
    WHERE uid='$_POST[uid]'
    ");



print"
    <script>
    alert('Jelszavát sikeresen módosíottuk')
    </script>
";

mysqli_close($adb);

?>