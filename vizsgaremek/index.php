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


    // Ellenőrizzük, hogy a `p` paraméter meg van-e adva
    $p = isset($_GET['p']) ? $_GET['p'] : "";

    // A `p` paraméter alapján eldöntjük, hogy a keret legyen-e betöltve
    $loadFrame = ($p === "" || $p === "konyv_lista" || $p === "konyv_reszletek.php?id=2");

    // Ha szükséges, megjelenítjük a fejléces keretet
    if ($loadFrame) {
        include("header.php");
    }

    // Betöltjük a tartalmi részt
    if (!isset($_SESSION['uid'])) {
        if ($p == "")                   include("kezdolap.php");
        else if ($p == "regisztracio")  include("vizsgaremek.html");
        else if ($p == "login")         include("login_form.php");
        else                            include("404_kulso.php");
    } else {
        if ($p == "")                       include("belsolap.php");
        else if ($p == "adatlapom")         include("adatlap_form.php");
        else if ($p == "jelszomodositas")   include("jelszomodositas.php");
        else if ($p == "konyv_lista")       include("konyv_lista.php");
        else if ($p == "konyvreszletek")    include("konyv_reszletek.php");
        else                                include("404_belso.php");
    }

    // Ha szükséges, megjelenítjük a lábléces keretet
    if ($loadFrame) {
        include("footer.php");
    }
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

            
            iframe{
                display:none;
            }
        </style>
    </head>
    <body>




    <iframe name="kisablak"></iframe>



    </body>
    </html>
