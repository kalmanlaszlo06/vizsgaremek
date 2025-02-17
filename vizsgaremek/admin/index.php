<?php



?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta name='robots' content='noindex'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<style>
    body{
        margin: 0;
    }
    div#menu{
        background-color:lightgrey;
        text-align:center;
        height:20px
    }
    div#menu a{
        display:inline-block;
        width:150px;
        text-decoration:none;
        font-weight:bold;
        color:black;
    }
    div#menu a:hover{
        color:white
    }
</style>

<body>
    <div id="menu" >
    <a href="../">Kezdőlap</a>
    <a href="./?p=userek">Userek, belépések</a>
    <a href="./?p=kerdesek">Kérdések</a>
    <a href="./?p=asd">Szerkesztés</a>
    <a href="./?p=ertekelesek">Értékelések, Válaszok</a>
    </div>

    <div id="tartalom">
<?php
    if(isset($_GET['p'])) $p = $_GET['p'];
    else           $p="";

    if ($p=="userek")       include("userek.php");
    if ($p=="kerdesek")     include("kerdesek.php");
    if ($p=="ertekelesek")  include("ertekelesek.php");

?>


    </div>
</body>
</html>