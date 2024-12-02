<?php
// Google Books API kulcs
$apiKey = 'AIzaSyCp1jq9ZMp5iqoDA1gBrMBJr8d4UNk11gg';

// Paraméterek kezelése
$mufaj = isset($_GET['mufaj']) ? $_GET['mufaj'] : 'all';
$kereses = isset($_GET['kereses']) ? $_GET['kereses'] : '';

// Keresési kifejezés generálása
if ($mufaj !== 'all') {
    $query = $mufaj;
    if (!empty($kereses)) {
        $query .= " " . $kereses;
    }
} else {
    $query = $kereses;
}

// API URL
$url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=$apiKey&maxResults=40";

// API válasz lekérése
$response = file_get_contents($url);
$data = json_decode($response, true);

// Ellenőrzés
if (!isset($data['items'])) {
    echo "<p>Nincs találat a keresésre.</p>";
    exit;
}
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
        padding: 20px;
    }

    .book-list {
        display: flex;
        flex-direction: column; /* Oszlopos elrendezés */
        gap: 20px; /* Távolság a könyvek között */
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
        <?php foreach ($data['items'] as $index => $item): ?>
            <?php 
                $volumeInfo = $item['volumeInfo'];
                $title = $volumeInfo['title'] ?? 'Cím nem elérhető';
                $authors = $volumeInfo['authors'] ?? ['Ismeretlen szerző'];
                $thumbnail = $volumeInfo['imageLinks']['thumbnail'] ?? 'nincs_kep.jpeg';
            ?>
            <div class="book-item">
                <!-- Könyv borító -->
                <img src="<?php echo htmlspecialchars($thumbnail); ?>" alt="<?php echo htmlspecialchars($title); ?>">

                <!-- Könyv részletek -->
                <div class="book-details">
                    <div class="book-title"><?php echo htmlspecialchars($title); ?></div>
                    <div class="book-author"><?php echo htmlspecialchars(implode(', ', $authors)); ?></div>
                    <a href="./?p=konyv_reszletek&id=<?php echo $index; ?>" class="book-link">Részletek</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
