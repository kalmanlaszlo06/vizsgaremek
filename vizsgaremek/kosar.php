<?php
require 'kapcsolat.php'; // Az adatbázis kapcsolatot biztosító fájl
include("header.php");

if (!isset($_SESSION['uid'])) {
    echo "<p>Kérjük, jelentkezz be a kosár megtekintéséhez!</p>";
    exit;
}

$uid = $_SESSION['uid'];

// Lekérjük a felhasználó kosárba tett könyveit
$query = "SELECT * FROM kosar WHERE uid = ?";
$stmt = mysqli_prepare($adb, $query);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookId = $row['kgid'];
    $cartItems[] = [
        'id' => $bookId,
        'title' => "Könyv címe", // API vagy adatbázis alapján
        'author' => "Szerző",   // API vagy adatbázis alapján
        'cover' => "image_link", // API vagy adatbázis alapján
        'price' => 2999 // Szimulált ár
    ];
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosár</title>
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
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #2a2c2f;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .book-details {
            display: flex;
            align-items: center;
        }
        .book-details img {
            width: 50px;
            height: auto;
            border-radius: 4px;
            margin-right: 15px;
        }
        .book-title {
            color: #ff6b6b;
            font-size: 16px;
            font-weight: bold;
        }
        .book-author {
            color: #fd7015;
            font-size: 13px;
        }
        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #e63946;
        }
        .btn-secondary {
            background-color: #fd7015;
        }
        .btn-secondary:hover {
            background-color: #d95c00;
        }

        /* Modális ablak stílusa */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: #2a2c2f;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            color: #e0e0e0;
        }
        .modal-content input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #555;
        }
        .modal-content .btn {
            width: 100%;
        }
        .modal-close {
            background: none;
            color: #ff6b6b;
            border: none;
            font-size: 20px;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        /* Korábbi stílusok itt */
        .step-hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="main-content">
    <h1>Kosár tartalma</h1>
    <ul id="cart-items">
        <?php foreach ($cartItems as $item): ?>
            <li data-id="<?= $item['id'] ?>">
                <div class="book-details">
                    <img src="<?= htmlspecialchars($item['cover']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                    <div>
                        <div class="book-title"><?= htmlspecialchars($item['title']) ?></div>
                        <div class="book-author"><?= htmlspecialchars($item['author']) ?></div>
                    </div>
                </div>
                <div class="actions">
                    <div class="book-price"><?= htmlspecialchars($item['price']) ?> Ft</div>
                    <button class="btn remove-item" data-id="<?= $item['id'] ?>">Eltávolítás</button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <button class="btn" id="checkout">Vásárlás</button>
    <a href="./?p=" class="btn btn-secondary">Vásárlás folytatása</a>
</div>

<!-- Modális ablak -->
<div class="modal" id="payment-modal">
    <div class="modal-content">
        <button class="modal-close" id="close-modal">&times;</button>
        <div id="payment-step-1">
            <h2>Fizetési mód</h2>
            <button class="btn payment-method" data-method="cash">Utánvét (készpénz)</button>
            <button class="btn payment-method" data-method="card">Bankkártya</button>
        </div>
        <div id="payment-step-2" class="step-hidden">
            <h2>Kártyaadatok</h2>
            <form id="payment-form" action="process_payment.php" method="POST">
                <input type="text" name="name" placeholder="Teljes név" required>
                <input type="text" name="card_number" placeholder="Kártyaszám" required>
                <input type="text" name="expiry" placeholder="Lejárati dátum (MM/YY)" required>
                <input type="text" name="cvv" placeholder="CVV" required>
                <button type="submit" class="btn">Fizetés</button>
            </form>
        </div>
        <div id="delivery-step" class="step-hidden">
            <h2>Szállítási adatok</h2>
            <form id="delivery-form">
                <input type="text" name="address" placeholder="Cím" required>
                <input type="text" name="city" placeholder="Város" required>
                <input type="text" name="postcode" placeholder="Irányítószám" required>
                <button type="submit" class="btn">Megrendelés</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Kosár elem eltávolítása
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', async function () {
            const bookId = this.dataset.id;

            const response = await fetch('remove_from_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: bookId })
            });

            const result = await response.json();
            if (result.success) {
                const item = document.querySelector(`li[data-id="${bookId}"]`);
                if (item) item.remove();
            } else {
                alert('Hiba történt az eltávolítás során.');
            }
        });
    });

    // Fizetési modal
    const checkoutButton = document.getElementById('checkout');
    const paymentModal = document.getElementById('payment-modal');
    const closeModal = document.getElementById('close-modal');
    const paymentStep1 = document.getElementById('payment-step-1');
    const paymentStep2 = document.getElementById('payment-step-2');
    const deliveryStep = document.getElementById('delivery-step');

    checkoutButton.addEventListener('click', () => {
        paymentModal.style.display = 'flex';
    });

    closeModal.addEventListener('click', () => {
        paymentModal.style.display = 'none';
        resetModal();
    });

    window.addEventListener('click', (event) => {
        if (event.target === paymentModal) {
            paymentModal.style.display = 'none';
            resetModal();
        }
    });

    document.querySelectorAll('.payment-method').forEach(button => {
        button.addEventListener('click', () => {
            const method = button.dataset.method;
            if (method === 'cash') {
                paymentStep1.style.display = 'none';
                deliveryStep.style.display = 'block';
            } else if (method === 'card') {
                paymentStep1.style.display = 'none';
                paymentStep2.style.display = 'block';
            }
        });
    });

    function resetModal() {
        paymentStep1.style.display = 'block';
        paymentStep2.style.display = 'none';
        deliveryStep.style.display = 'none';
    }
</script>
</body>
</html>



