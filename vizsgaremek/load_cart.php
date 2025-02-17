<?php
session_start();
require_once('kapcsolat.php'); // Adatbázis kapcsolat

function getBookDetails($bookId) {
    $apiUrl = "https://www.googleapis.com/books/v1/volumes/" . urlencode($bookId);
    $response = file_get_contents($apiUrl);
    if ($response) {
        $bookData = json_decode($response, true);
        if (isset($bookData['volumeInfo'])) {
            return [
                'title' => $bookData['volumeInfo']['title'] ?? 'N/A',
                'thumbnail' => $bookData['volumeInfo']['imageLinks']['thumbnail'] ?? 'nincs_kep.jpg'
            ];
        }
    }
    return ['title' => 'Ismeretlen könyv', 'thumbnail' => 'nincs_kep.jpg'];
}

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $query = mysqli_query($adb, "SELECT * FROM kosar WHERE uid='$uid'");
    
    if (mysqli_num_rows($query) > 0) {
        while ($item = mysqli_fetch_assoc($query)) {
            $bookDetails = getBookDetails($item['kgid']);
            $bookId = htmlspecialchars($item['kgid']);
            $bookTitle = htmlspecialchars($bookDetails['title']);
            $bookThumbnail = htmlspecialchars($bookDetails['thumbnail']);

            echo "<div class='cart-item' style='display: flex; align-items: center; gap: 10px;'>";
            echo "<a href='./?p=konyvreszletek&id={$bookId}' style='text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;'>";
            echo "<img src='{$bookThumbnail}' alt='Borító' style='width: 50px; height: auto;'>";
            echo "<span class='book-title' style='color: black;'>{$bookTitle}</span>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<p>A kosár üres.</p>";
    }
} else {
    echo "<p>Kérlek, jelentkezz be a kosár megtekintéséhez.</p>";
}
?>
