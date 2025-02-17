<?php
ob_start();
include("kapcsolat.php"); // Adatbázis kapcsolat
include("header.php");

$id = $_GET['id'] ?? '';
$apiKey = 'AIzaSyCp1jq9ZMp5iqoDA1gBrMBJr8d4UNk11gg';

if ($id) {
    $url = "https://www.googleapis.com/books/v1/volumes/" . urlencode($id) . "?key=$apiKey";
    $response = file_get_contents($url);

    if ($response === false) {
        die("Nem sikerült lekérdezni az API-t.");
    }

    $book = json_decode($response, true);

    if (!$book || isset($book['error'])) {
        die("Hiba történt az API válasz feldolgozásakor: " . htmlspecialchars($book['error']['message'] ?? 'Ismeretlen hiba.'));
    }
} else {
    die("Hiányzó azonosító.");
}

$title = htmlspecialchars($book['volumeInfo']['title'] ?? 'N/A');
$authors = htmlspecialchars(implode(', ', $book['volumeInfo']['authors'] ?? ['Ismeretlen szerző']));
$pageCount = htmlspecialchars($book['volumeInfo']['pageCount'] ?? 'N/A');
$language = htmlspecialchars($book['volumeInfo']['language'] ?? 'N/A');
$publishedDate = htmlspecialchars($book['volumeInfo']['publishedDate'] ?? 'N/A');
$description = htmlspecialchars($book['volumeInfo']['description'] ?? 'Nincs leírás.');
$thumbnail = $book['volumeInfo']['imageLinks']['thumbnail'] ?? 'konyvkepek/nincs_kep.jpg';

$query = "SELECT kid FROM konyvek WHERE kgid = '" . mysqli_real_escape_string($adb, $id) . "'";
$result = mysqli_query($adb, $query);

if (mysqli_num_rows($result) === 0) {
    $kcim = mysqli_real_escape_string($adb, htmlspecialchars($book['volumeInfo']['title'] ?? 'N/A'));
    $kszerzo = mysqli_real_escape_string($adb, htmlspecialchars(implode(', ', $book['volumeInfo']['authors'] ?? ['Ismeretlen szerző'])));
    $kmufaj = mysqli_real_escape_string($adb, htmlspecialchars(implode(', ', $book['volumeInfo']['categories'] ?? ['Ismeretlen műfaj'])));
    $kleiras = mysqli_real_escape_string($adb, htmlspecialchars($book['volumeInfo']['description'] ?? 'Nincs leírás.'));
    $kstatusz = mysqli_real_escape_string($adb, 'elérhető');

    $insertQuery = "
        INSERT INTO konyvek (kgid, kcim, kmufaj, kszerzo, kleiras, kstatusz)
        VALUES (
            '" . mysqli_real_escape_string($adb, $id) . "',
            '$kcim',
            '$kmufaj',
            '$kszerzo',
            '$kleiras',
            '$kstatusz'
        )
    ";
    if (!mysqli_query($adb, $insertQuery)) {
        die("Hiba a könyv adatainak mentésekor: " . mysqli_error($adb));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_SESSION['uid'] ?? 0;
    $ertekeles = intval($_POST['rating'] ?? 0);
    $eszoveg = mysqli_real_escape_string($adb, $_POST['comment'] ?? "");

    if ($uid && $ertekeles >= 1 && $ertekeles <= 5 && $eszoveg) {
        $query = "INSERT INTO ertekelesek (uid, konyvid, ertekeles, eszoveg, edatum, epontosido)
                  VALUES (
                      '$uid',
                      '" . mysqli_real_escape_string($adb, $id) . "',
                      '$ertekeles',
                      '$eszoveg',
                      NOW(),
                      NOW()
                  )";
        mysqli_query($adb, $query);

        ob_clean(); // Clear any output before redirect
        exit("<script>window.location.href = './?p=konyvreszletek&id=$id';</script>");
    } else {
        $error = "Az értékelés nem sikerült. Minden mezőt ki kell tölteni!";
    }
}

$reviews = [];
$query = "SELECT e.ertekeles, e.eszoveg, e.edatum, e.epontosido, u.username 
          FROM ertekelesek e
          LEFT JOIN user u ON e.uid = u.uid
          WHERE e.konyvid = '" . mysqli_real_escape_string($adb, $id) . "'
          ORDER BY e.edatum DESC";
$result = mysqli_query($adb, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $row['ertekeles'] = max(1, min(5, intval($row['ertekeles'])));
    $reviews[] = $row;
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
  
</head>
<body>
<div class="valami">
    <div class="book-details-container">
        <div class="book-info-container">
            <img src="<?php echo htmlspecialchars($thumbnail ?? 'konyvkepek/nincs_kep.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($title ?? 'N/A'); ?>" 
                 class="book-cover">
            <div class="book-details">
                <div class="book-title"><?php echo htmlspecialchars($title ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Szerző:</strong> <?php echo htmlspecialchars($authors ?? 'Ismeretlen szerző'); ?></div>
                <div class="book-detail"><strong>Oldalszám:</strong> <?php echo htmlspecialchars($pageCount ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Nyelv:</strong> <?php echo htmlspecialchars($language ?? 'N/A'); ?></div>
                <div class="book-detail"><strong>Kiadás dátuma:</strong> <?php echo htmlspecialchars($publishedDate ?? 'N/A'); ?></div>
            </div>
        </div>
        <div class="book-description">
            <strong>Leírás:</strong> <?php echo htmlspecialchars($description ?? 'N/A'); ?>
        </div>

        <div class="actions">
            <button id="gomb" onclick="alert('Vásárlás sikeres!')">Vásárlás</button>
            <button id="gomb" onclick="alert('Kölcsönzés sikeres!')">Kölcsönzés</button>
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
                <input type="hidden" name="rating" id="rating" value="0" required>
                <textarea name="comment" rows="4" placeholder="Írja meg a véleményét..." required></textarea>
                <button id="gomb" type="submit">Küldés</button>
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
                        <div class="" id="ratingstars2">
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

        <!-- Modal for enlarged image -->
        <div id="modal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="modal-img">
        </div>

        <script>
            const modal = document.getElementById("modal");
            const modalImg = document.getElementById("modal-img");
            const closeBtn = document.querySelector(".close");

            document.querySelector(".book-cover").addEventListener("click", function() {
                modal.style.display = "block";
                modalImg.src = this.src; // A kép forrásának átadása
            });

            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        </script>

    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".rating-stars span");
    const ratingInput = document.getElementById("rating");

    stars.forEach(star => {
        star.addEventListener("click", function() {
            const ratingValue = this.getAttribute("data-value");
            ratingInput.value = ratingValue;

            // Frissítjük a csillagok megjelenését
            stars.forEach(s => s.classList.remove("active"));
            for (let i = 0; i < ratingValue; i++) {
                stars[i].classList.add("active");
            }
        });
    });

    // Eseménykezelő hover-re, ha vizuális visszajelzést szeretnél
    stars.forEach(star => {
        star.addEventListener("mouseover", function() {
            const ratingValue = this.getAttribute("data-value");

            stars.forEach(s => s.classList.remove("active-hover"));
            for (let i = 0; i < ratingValue; i++) {
                stars[i].classList.add("active-hover");
            }
        });

        star.addEventListener("mouseout", function() {
            stars.forEach(s => s.classList.remove("active-hover"));
        });
    });
});
</script>
  <style>
.modal {
    display: none; /* Alapértelmezés szerint rejtett */
    position: fixed;
    z-index: 1000; /* Legfelső szinten jelenjen meg */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Félátlátszó fekete háttér */
    align-content: center; /* Kép középre igazítása függőlegesen */
    justify-content: center; /* Kép középre igazítása vízszintesen */
    overflow: hidden; /* Rejtett görgetősáv */
} 
.modal-content {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    animation: zoomIn 0.5s;
    
}

@keyframes zoomIn {
    from {
        transform: scale(0.5);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s;
}

.close:hover {
    color: #ff6b6b;
}
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

.kuldes{
color:white;
background-color: #ff6b6b;
font-weight:bold;
width: 100%;
max-width: 100%; 
}
.kuldes:hover{
background-color: red;
}

.valami{
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

body{
    
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
    align-items: flex-start; /* Igazítsa a tetejét */
    gap: 20px; /* Távolság a kép és a részletek között */
}

.book-cover {
    max-width: 300px; /* Nagyobb kép */
    height: auto;
    border-radius: 8px;
    display: block;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
    border: 2px solid #ff6b6b;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.book-cover:hover {
    transform: scale(1.05); /* Enyhe nagyítás hover-re */
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.7); /* Mélyebb árnyék hover-re */
}



.book-info {
    margin-left: 20px;
    flex: 1;
}

.book-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #ff6b6b;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Szöveg árnyék */
}
.book-details {
    flex: 1;
    font-size: 18px; /* Nagyobb szöveg */
    color: #e0e0e0;
}
.book-detail strong {
    color: #ff6b6b; /* Kiemelés a "Szerző", "Oldalszám" stb. előtt */
}
.book-detail {
    flex: 1;
    padding: 10px 15px;
    background-color: #2a2c2f;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Árnyék a szöveg doboz körül */
}
.book-description {
    margin-top: 20px;
    padding: 10px;
    background-color: #2a2c2f;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
    font-size: 16px;
    color: #e0e0e0;
    line-height: 1.6;
}
.book-description strong {
    color: #ff6b6b; /* Kiemelés a "Szerző", "Oldalszám" stb. előtt */
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
#ratingstars2{
    display: flex;
    gap: 5px;
}
#ratingstars2 span {
    font-size: 20px;
    pointer-events: none;
}
#ratingstars2 span.active {
    color: #ff6b6b;
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

textarea, #gomb {
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
</body>
</html>




