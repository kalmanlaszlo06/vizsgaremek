<?php
include('kapcsolat.php');
$konyv = mysqli_query($adb,"SELECT * FROM klista WHERE uid ='$_SESSION[uid]'");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Könyvlista</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #1d1f21;
        color: #e0e0e0;
    }

    .book-list {
        display: flex;
        flex-direction: column; /* Oszlopos elrendezés */
        gap: 20px; /* Távolság a könyvek között */
        padding-right: 20px;
        padding-left: 20px;
    }

    .book-item {
        background-color: #2a2c2f;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: flex-start; /* Igazítás a könyv eleje szerint */
        gap: 15px; /* Távolság az elemeken belül */
    }

    .book-item img {
        max-width: 100px; /* Kis méretű kép */
        height: auto;
        border-radius: 8px;
    }

    .book-details {
        flex: 1; /* Rugalmasan kitölti a helyet */
    }

    .book-title {
        font-size: 18px;
        color: #ff6b6b;
        margin-bottom: 5px;
    }

    .book-author {
        font-size: 14px;
        color: #aaa;
        margin-bottom: 10px;
    }

    .book-link {
        text-decoration: none;
        color: #e0e0e0;
        display: inline-block;
        margin-top: 10px;
    }

    .book-link:hover {
        color: #ff6b6b;
    }
</style>
</head>
<body>
<div class="book-list">
    <?php
    if ($konyv != null){
        if (mysqli_num_rows($konyv) > 0) {
            while ($konyv = mysqli_fetch_array($konyv, MYSQLI_ASSOC)) {
                echo'<div class="book-item">';

                echo'<img src=" '.htmlspecialchars($konyv["borito"]).'" alt ="hiba">';

                echo'<div class="book-details">';
                echo'    <div class="book-title">'.htmlspecialchars($konyv['kcim']) .'</div>';
                echo'    <div class="book-author">'. ($konyv['iro'] != NULL ? htmlspecialchars($konyv['iro']) : 'nem ismert/nem talált').'</div>';
                echo'    <div class="book-score">'. htmlspecialchars().'</div>';
                echo'</div>';
                echo'</div>';
            }
        }else{
            echo "nincs találat / nincs még felvéve könyv";
        }
    }else{
        echo "nincs találat / nincs még felvéve könyv";
    }?>
</div>
</body>
</html>
