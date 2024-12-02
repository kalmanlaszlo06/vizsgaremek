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
    <h1>Könyvek Google Books API alapján</h1>
    <div class="book-grid">
    <?php
// Google Books API kulcs és URL
$apiKey = 'AIzaSyCp1jq9ZMp5iqoDA1gBrMBJr8d4UNk11gg';
$query = 'action'; // A keresett kifejezés
$url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=$apiKey&maxResults=40";

// API hívás és válasz kezelése
$response = file_get_contents($url);
$data = json_decode($response, true);

// Könyvek megjelenítése
if (isset($data['items']) && count($data['items']) > 0) {
    foreach ($data['items'] as $index => $book) { // Az $index lesz az egyedi azonosító
        $title = $book['volumeInfo']['title'] ?? 'N/A';
        $author = implode(', ', $book['volumeInfo']['authors'] ?? ['Ismeretlen szerző']);
        $cover = $book['volumeInfo']['imageLinks']['thumbnail'] ?? 'nincs_kep.jpeg';
        $price = $book['saleInfo']['listPrice']['amount'] ?? 'Ár nem elérhető';

        // A konyv_reszletek.php-ra mutató link generálása az $index alapján
        echo "<a href='konyv_reszletek.php?id=$index' style='text-decoration: none; color: inherit;'>";
        echo "<div class='book-card'>";
        echo "<img src='" . htmlspecialchars($cover) . "' alt='" . htmlspecialchars($title) . "' class='book-cover'>";
        echo "<div class='book-title'>" . htmlspecialchars($title) . "</div>";
        echo "<div class='book-author'>" . htmlspecialchars($author) . "</div>";
        echo "<div class='book-price'>" . htmlspecialchars($price) . " Ft</div>";
        echo "</div>";
        echo "</a>";
    }
} else {
    echo "<p>Nincs találat.</p>";
}
?>

    </div>
</div>
</body>
</html>
