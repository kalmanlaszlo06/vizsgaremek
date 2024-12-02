<?php
//include("header.php")
include("kapcsolat.php"); // Adatbázis kapcsolat
session_start(); // Session indítása, ha még nem történt meg


$apiKey = 'AIzaSyCp1jq9ZMp5iqoDA1gBrMBJr8d4UNk11gg';
$query = 'romance'; // Az eredeti keresési kifejezés
$url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=$apiKey&maxResults=40";

// API válasz lekérése
$response = file_get_contents($url);
$data = json_decode($response, true);

// Könyv azonosítójának lekérése az URL-ből
$bookId = isset($_GET['id']) ? intval($_GET['id']) : -1;

// Ellenőrzés: létezik-e a könyv
if (isset($data['items'][$bookId])) {
    $book = $data['items'][$bookId]['volumeInfo'];
} else {
    die("Könyv nem található.");
}

// Új értékelés mentése az adatbázisba
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = isset($_SESSION['uid']) ? intval($_SESSION['uid']) : 0;
    $ertekeles = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $eszoveg = isset($_POST['comment']) ? mysqli_real_escape_string($adb, $_POST['comment']) : "";
    $konyvid = $bookId;

    if ($uid && $ertekeles >= 1 && $ertekeles <= 5 && $eszoveg) {
        $query = "
            INSERT INTO ertekelesek (uid, konyvid, ertekeles, eszoveg, edatum)
            VALUES ($uid, $konyvid, $ertekeles, '$eszoveg', NOW())
        ";
        mysqli_query($adb, $query);
        header("Location: konyv_reszletek.php?id=$bookId"); // Oldal újratöltése
        exit;
    } else {
        $error = "Az értékelés nem sikerült. Minden mezőt ki kell tölteni!";
    }
}

// Értékelések lekérdezése az adatbázisból
$reviews = [];
$query = "SELECT e.ertekeles, e.eszoveg, e.edatum, u.username 
          FROM ertekelesek e
          LEFT JOIN user u ON e.uid = u.uid
          WHERE e.konyvid = $bookId
          ORDER BY e.edatum DESC";

$result = mysqli_query($adb, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?></title>
    <style>

        
        textarea {
    width: 100%; /* 100%-os szélesség */
    max-width: 100%; /* Ne lépje túl a konténer szélességét */
    height: 120px; /* Fix magasság */
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    box-sizing: border-box; /* A padding is beletartozik a szélességbe */
}

button {
    color:white;
    background-color: #ff6b6b;
    font-weight:bold;
    width: 100%; /* 100%-os szélesség a gombnak is */
    max-width: 100%; /* Ne lépje túl a konténer szélességét */
}
button:hover{
    background-color: red;
}

        body {
            align-items:center;
            font-family: Arial, sans-serif;
            background-color: #1d1f21;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .book-details-container {
            
            display: flex;
            flex-direction: column;
            background-color: #2a2c2f;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
        }

        .book-info-container {
            display: flex;
            flex-wrap: wrap;
        }

        .book-cover {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .book-info {
            margin-left: 20px;
            flex: 1;
        }

        .book-title {
            color: #ff6b6b;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .book-detail {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .book-price {
            margin-top: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #a3e635;
        }

        .actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .actions button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .actions button:hover {
            background-color: #e65a5a;
        }

        .rating-section {
            margin-top: 30px;
            background-color: #1f2123;
            padding: 20px;
            border-radius: 8px;
        }

        .rating-section h3 {
            color: #e0e0e0;
        }

        .rating-stars {
            display: flex;
            gap: 5px;
            cursor: pointer;
        }

        .rating-stars span {
            font-size: 30px;
            color: #888;
            transition: color 0.3s;
        }

        .rating-stars span:hover,
        .rating-stars span.active {
            color: #ff6b6b;
        }

        textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        .reviews-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #1f2123;
            border-radius: 8px;
        }

        .review {
            margin-bottom: 15px;
        }

        .review strong {
            color: #ff6b6b;
        }

        .review small {
            display: block;
            color: #aaa;
            margin-top: 5px;
        }

        hr {
            border: none;
            border-top: 1px solid #444;
            margin: 10px 0;
        }


    </style>
</head>
<body>

    <div class="book-details-container">
    <div class="book-info-container">
            <img src="<?php echo htmlspecialchars($book['imageLinks']['thumbnail'] ?? 'nincs_kep.jpeg'); ?>" 
                 alt="<?php echo htmlspecialchars($book['title'] ?? 'N/A'); ?>" 
                 class="book-cover">
            <div class="book-info">
                <div class="book-title"><?php echo htmlspecialchars($book['title'] ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Szerző:</strong> <?php echo htmlspecialchars(implode(', ', $book['authors'] ?? ['Ismeretlen szerző'])); ?></div>
                <div class="book-detail"><strong>Oldalszám:</strong> <?php echo htmlspecialchars($book['pageCount'] ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Nyelv:</strong> <?php echo htmlspecialchars($book['language'] ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Kiadás dátuma:</strong> <?php echo htmlspecialchars($book['publishedDate'] ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Leírás:</strong> <?php echo htmlspecialchars($book['description'] ?? 'N/A'); ?></div>
            </div>
        </div>

        <div class="actions">
            <button onclick="alert('Vásárlás sikeres!')">Vásárlás</button>
            <button onclick="alert('Kölcsönzés sikeres!')">Kölcsönzés</button>
        </div>

        <div class="rating-section">
            <h3>Értékelje a könyvet</h3>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <form method="POST" action="">
                <div class="rating-stars" id="rating-stars">
                    <span data-value="1">&#9733;</span>
                    <span data-value="2">&#9733;</span>
                    <span data-value="3">&#9733;</span>
                    <span data-value="4">&#9733;</span>
                    <span data-value="5">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="rating" required>
                <textarea name="comment" rows="4" placeholder="Írja meg a véleményét..." required></textarea>
                <button type="submit">Küldés</button>
            </form>
        </div>

        <div class="reviews-section">
    <h3>Felhasználói értékelések</h3>
    <?php if (empty($reviews)): ?>
        <p>Még nincsenek értékelések ehhez a könyvhöz.</p>
    <?php else: ?>
        <?php foreach ($reviews as $review): ?>
            <div class="review">
                <strong><?php echo htmlspecialchars($review['username'] ?? "Anonim"); ?></strong>
                <div class="rating-stars">
                    <?php
                    $rating = intval($review['ertekeles']); // A csillagok számát a lekért értékelés határozza meg
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<span class="active">&#9733;</span>'; // Aktív csillag (piros)
                        } else {
                            echo '<span>&#9733;</span>'; // Üres csillag (szürke)
                        }
                    }
                    ?>
                </div>
                <p><?php echo htmlspecialchars($review['eszoveg']); ?></p>
                <small><?php echo htmlspecialchars($review['edatum']); ?></small>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</div>



    <script>
        const stars = document.querySelectorAll('#rating-stars span');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                ratingInput.value = value;
                stars.forEach(s => s.classList.remove('active'));
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
