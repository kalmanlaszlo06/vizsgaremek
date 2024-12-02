<?php

print_r($_POST);
if($_POST['username']=="" )
    die("<script> alert('Nem adtad meg a felhasználóneved!') </script>");

if($_POST['keresztnev']=="" )
    die("<script> alert('Nem adtad meg a keresztneved!') </script>");

if($_POST['vezeteknev']=="" )
    die("<script> alert('Nem adtad meg a vezetékneved!') </script>");

if($_POST['email']=="" )
    die("<script> alert('Nem adtad meg az email címed!') </script>");

if($_POST['password']=="" )
    die("<script> alert('Nem adtad meg a jelszavad!') </script>");

if($_POST['telefonszam']=="" )
    die("<script> alert('Nem adtad meg a telefonszámod!') </script>");

if($_POST['szuldatum']=="" )
    die("<script> alert('Nem adtad meg a születési dátumod!') </script>");


    

include("kapcsolat.php");


// var_dump($adb);
//$upw = md5($_POST['password']);

mysqli_query($adb , "
INSERT INTO user ( uid,             username,            uemail,          password,          uszuldatum, udatum, uip, usession, ustatusz, ukomment,         ufirstname,                   ulastname) 
VALUES           (NULL, '$_POST[username]',     '$_POST[email]',            '$_POST[password]', '$_POST[szuldatum]',  NOW(),  '',  '',       '',       '',         '$_POST[keresztnev]',        '$_POST[vezeteknev]')
");

mysqli_close($adb);

print "<script> parent.location.href = './login_form.php' </script>";
?>