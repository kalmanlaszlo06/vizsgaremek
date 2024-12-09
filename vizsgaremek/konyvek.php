<?php
    include("kapcsolat.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Könyvek</title>
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
    .main-content {
        text-align: center;
        margin-top: 50px;
        padding: 0 20px;
        flex: 1;
    }
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    .book-card {
        background-color: #2a2c2f;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        text-align: center;
        padding: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }
    .book-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
    }
    .book-cover {
        width: 100%;
        height: auto;
        max-height: 180px;
        object-fit: cover;
        border-radius: 4px;
    }
    .book-title {
        color: #ff6b6b;
        font-size: 16px;
        margin: 8px 0 4px;
        font-weight: bold;
    }
    .book-author {
        color: #fd7015;
        font-size: 13px;
        margin-bottom: 4px;
    }
    .book-price {
        color: #a3e635;
        font-size: 14px;
        font-weight: bold;
        margin-top: 6px;
    }
</style>
</head>
<body>
<div class="main-content">
    <form action="./?p=konyv_lista" method="get" id="book-search">
        <input type="hidden" name="p" value="konyv_lista">
        <input type="text" name="kereses" placeholder="Keresés könyv címe szerint...">
        <input type="submit" value="Keresés">
    </form>
    <div class="book-grid">
    <?php
        $konyvek = mysqli_query($adb , "SELECT * FROM konyvek WHERE statusz = 'a'");
        $kony = mysqli_fetch_array($konyvek);
        //print_r($kony);
        if (count($kony) > 0) {
            foreach($kony as $value) {
                // post id és nem tudom hogy hivatkozak a elemekre
                echo "<a href='./?p=konyvreszletek' style='text-decoration: none; color: inherit;'>";
                echo "<div class='book-card'>";
                echo "<img src='" . $value[3] . "' alt='" . $value[2] . "' class='book-cover'>";
                echo "<div class='book-title'>" . htmlspecialchars($title) . "</div>";
                echo "<div class='book-author'>" . htmlspecialchars($author) . "</div>";
                echo "<div class='book-price'>" . htmlspecialchars($price) . " Ft</div>";
                echo "</div>";
                echo "</a>";
            }
        } else{
            echo "nincs találat";
        }
        ?>
    </div>
</div>
</body>
</html>
