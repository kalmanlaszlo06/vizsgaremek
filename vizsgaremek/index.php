<?php
    session_start();
    include("kapcsolat.php");
    $ip = $_SERVER['REMOTE_ADDR'];
    $sess = substr(session_id(), 0, 8);
    if (isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
    else $uid = 0;
    $url = $_SERVER['REQUEST_URI'];
    mysqli_query($adb, 
    " INSERT INTO naplo (nid, ndate, nip, nsession, nuid, nurl) 
    VALUES (NULL, NOW(), '$ip', '$sess', '$uid', '$url')");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1d1f21;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
    </style>
</head>
<body>
<style>
    iframe{
        display:none;
    }
    /* Header styling */
    #login {
        font-family: Arial, sans-serif; 
        background-color: #333;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        /* eltávolítottuk az align-items: center; */
        color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }   
    /* Left Menu styling */
    #menu-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }   
    /* Right Menu (User Info) styling */
    #menu-right {
        display: flex;
        align-items: center;
    }   
    #menu-right img {
        border-radius: 50%;
        width: 45px;
        height: 45px;
        margin-right: 10px;
    }   
    #menu-right a {
        color: #fd7015;
        text-decoration: none;
        font-weight: bold;
        margin-left: 15px;
        font-size: 16px;
    }   
    #menu-right input[type="button"] {
        background-color: #fd7015;
        color: #fff;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 15px;
        margin-left: 10px;
        transition: background-color 0.3s;
    }   
    #menu-right input[type="button"]:hover {
        background-color: #e0630d;
    }   
    /* Dropdown styling */
    #genres-dropdown {
        position: relative;
    }   
    /* Styling for the "Műfajok" button */
    #genres-button {
        background-color: #333;
        color: #fd7015;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s, color 0.3s;
    }   
    #genres-button:hover {
        background-color: #444;
        color: #ffffff;
    }   
    #genres-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        z-index: 1;
        min-width: 150px;
    }   
    #genres-content a {
        display: block;
        color: #fd7015;
        padding: 10px 15px;
        text-decoration: none;
        font-size: 14px;
    }   
    #genres-content a:hover {
        background-color: #444;
    }   
    #genres-dropdown:hover #genres-content {
        display: block;
    }   
    /* Book Search */
    #book-search input[type="text"] {
        padding: 8px;
        border: 1px solid #333;
        border-radius: 5px;
        background-color: #222;
        color: #f1f1f1;
        outline: none;
    }   
    #book-search input[type="submit"] {
        background-color: #fd7015;
        color: #fff;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 5px;
        margin-left: 5px;
        transition: background-color 0.3s;
    }   
    #book-search input[type="submit"]:hover {
        background-color: #e0630d;
    }   
    /* Main content styling */
    .main-content {
        text-align: center;
        margin-top: 50px;
        flex: 1;
    }   
    h1 {
        color: #ff6b6b;
        font-size: 36px;
        margin-bottom: 20px;
    }   
    /* Footer styling */

    iframe{
        display:none;
    }   
    /* Styling for the "Kezdőlap" button */
    #menu-left a button {
        background-color: #333;
        color: #fd7015;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 15px;
        transition: background-color 0.3s, color 0.3s;
    }   
    #menu-left a button:hover {
        background-color: #444;
        color: #ffffff;
    }
</style>
<body>
<div id="login">
    <div id="menu-left">
        <!--bookli ikon!!!-->
        <a href="./?p="><button>Kezdőlap</button></a>
        <a href="./?p=konyv_lista"><button>Könyvek</button></a>
        <!--<div id="genres-dropdown">
            <button id="genres-button">Műfajok</button>
            <div id="genres-content">
                <a href="./?p=konyv_lista&mufaj=all">Összes műfaj</a>
                <a href="./?p=konyv_lista&mufaj=regeny">Regény</a>
                <a href="./?p=konyv_lista&mufaj=fantasy">Fantasy</a>
                <a href="./?p=konyv_lista&mufaj=krimi">Krimi</a>
                <a href="./?p=konyv_lista&mufaj=sci-fi">Sci-fi</a>
            </div>
        </div>-->
        <!---->
        <form action="./?p=konyv_lista" method="get" id="book-search">
            <input type="hidden" name="p" value="konyv_lista">
            <input type="text" name="kereses" placeholder="Keresés könyv címe szerint...">
            <input type="submit" value="Keresés">
        </form>
    </div>

    <div id="menu-right">
        <?php
        if (isset($_SESSION['uid'])) {
            $userQuery = mysqli_query($adb, "SELECT * FROM user WHERE uid='$_SESSION[uid]'");
            $user = mysqli_fetch_assoc($userQuery);

            if (!empty($user['uprofkepnev'])) {
                $profkep = "./profilkepek/" . htmlspecialchars($user['uprofkepnev_eredetinev']);
            } else {
                $profkep = "./profilkepek/alapprofilkep.jfif";
            }

            echo "<img src='$profkep' alt='Profilkép'>";
            echo "<a href='./?p=adatlapom'>" . htmlspecialchars($user['username']) . "</a>";
            echo "<input type='button' value='Kilépés' onclick='kisablak.location.href=\"logout.php\"'>";
        } else {
            echo "<input type='button' value='Belépés' onclick='location.href=\"./?p=login\"'>";
        }
        ?>
    </div>
</div>
<?php
    if (isset($_GET['p'])) $p=$_GET['p']; else $p="";
    if (!isset($_SESSION['uid'])) {
        if ($p == "")                   include("kezdolap.php");
        else if ($p == "reg")           include("regisztracio.php");
        else if ($p == "login")         include("login_form.php");
        else                            include("404.php");
    } else {
        if ($p == "")                       include("belsolap.php");
        else if ($p == "adatlapom")         include("adatlap_form.php");
        else if ($p == "jelszomodositas")   include("jelszomodositas.php");
        else if ($p == "konyv_lista")       include("konyv_lista.php");
        else if ($p == "konyvreszletek")    include("konyv_reszletek.php");
        else                                include("404.php");
    }
?>
<iframe name="kisablak"></iframe>
<footer>
    <p>&copy; 2024 Bookli.hu. Minden jog fenntartva.</p>
</footer>
</body>
</html>


    
