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
    if (isset($_SESSION['uid'])) {
        $adm = mysqli_query($adb , "SELECT * FROM user WHERE uid = '$_SESSION[uid]' AND ustatusz = 'b'");
        if ($adm) {
            $admi = mysqli_fetch_array($adm, MYSQLI_ASSOC);
        }
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Főoldal</title>
</head>
<body>
<style>
    .support-tab {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ff6b6b;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        font-size: 16px;
        font-weight: bold;
        z-index: 1000;
    }
    /* Popup ablak */
    .support-popup {
        display: none;
        position: fixed;
        bottom: 70px;
        right: 20px;
        width: 300px;
        background-color: #2c2f33;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        padding: 20px;
        z-index: 1001;
    }

    .support-popup textarea {
        width: 100%;
        height: 80px;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
        resize: none;
    }

    .support-popup button {
        background-color: #ff6b6b;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        margin-top: 10px;
        float: right;
    }
    
    
</style>
<body>
<div id="login">
    <div id="menu-left">
        <a href="./?p=" id="cimke"><b>B</b>ookli</a>
        <a href="./?p="><button>Kezdőlap</button></a>
        <a href="./?p=konyvek"><button>Könyvek</button></a>
        <?php
        if (isset($_SESSION['uid'])) {
            echo '<a href="./?p=konyv_lista"><button>Saját listám</button></a>';
        }
        if (isset($_SESSION['uid']) && isset($admi)) {
            echo '<a href="admin/index.php"><button>Admin</button></a>';
        }
        ?>
    </div>

    <div id="menu-right">
    <div id="cart-container" style="position: relative;">
            <div id="cart-icon" style="cursor: pointer; position: relative;">
                <button id="kosarbutton" onclick="location.href='./?p=kosar'">🛒 <span id="cart-count">0</span> </button>
            </div>
            <div id="cart-dropdown" style="position: absolute; top: 25px; right: 0; display: none; background: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 10px; width: 300px; border-radius: 8px;">
                <p style="color:black;"><strong>Kosár tartalma:</strong></p>
                <div id="cart-items" style="max-height: 200px; overflow-y: auto;">
                    <!-- Kosár elemek itt fognak megjelenni -->
                </div>
                <button id="kosarbutton" onclick="location.href='./?p=kosar'">Kosár megtekintése</button>
            </div>
        </div>

    <script>
    // Kosár ikon hover eseménye
    document.getElementById('cart-icon').addEventListener('mouseenter', function() {
        document.getElementById('cart-dropdown').style.display = 'block'; // Kosár megjelenítése
        loadCartItems(); // Kosár elemek betöltése
    });

    // Kosár tartalom hover eseménye, hogy ne tűnjön el gyorsan
    document.getElementById('cart-dropdown').addEventListener('mouseenter', function() {
        this.style.display = 'block'; // Kosár tartalom megjelenítése
    });

    // Kosár ikon eltűnése, ha az egér elhagyja az ikont és nem a tartalom fölött van
    document.getElementById('cart-icon').addEventListener('mouseleave', function() {
        setTimeout(function() {
            if (!document.getElementById('cart-dropdown').matches(':hover')) {
                document.getElementById('cart-dropdown').style.display = 'none'; // Kosár eltűnése
            }
        }, 200); // Kis késleltetés hozzáadása
    });

    // Kosár tartalom eltűnése, ha az egér elhagyja a tartalmat
    document.getElementById('cart-dropdown').addEventListener('mouseleave', function() {
        this.style.display = 'none'; // Kosár eltűnése
    });

    // Kosár elemek betöltése
    function loadCartItems() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'load_cart.php', true); // Kosár elemek lekérése egy külön fájlból (load_cart.php)
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('cart-items').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();

    function updateCartCount() {
        fetch('cart_count.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cart-count').textContent = data.cartCount;
                } else {
                    console.error('Hiba a kosár számának lekérésekor:', data.message);
                }
            })
            .catch(error => console.error('Hálózati hiba:', error));
    }
});

    </script>
        <?php
        if (isset($_SESSION['uid'])) {
            $userQuery = mysqli_query($adb, "SELECT * FROM user WHERE uid='$_SESSION[uid]'");
            $user = mysqli_fetch_assoc($userQuery);

            if (!empty($user['uprofkepnev'])) {
                $profkep = "./profilkepek/" . htmlspecialchars($user['uprofkepnev']);
            } else {
                $profkep = "./profilkepek/picon2.png";
            }

            echo "<a href='./?p=adatlapom'><img src='$profkep' alt='Profilkép'></a>";
            echo "<a href='./?p=adatlapom'>" . htmlspecialchars($user['username']) . "</a>";
            echo "<input type='button' value='Kilépés' onclick='kisablak.location.href=\"logout.php\"'>";
        } else {
            echo "<input type='button' value='Belépés' onclick='location.href=\"./?p=login\"'>";
        }
        ?>
    </div>
</div>

<div class="support-tab" onclick="toggleSupportPopup()">💬 Support</div>
<div class="support-popup" id="supportPopup">
    <textarea id="supportMessage" placeholder="Írja le a kérdését..."></textarea>
    <button onclick="sendSupportMessage()">Küldés</button>
</div>
<script>
    function toggleSupportPopup() {
        const popup = document.getElementById('supportPopup');
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    }

    function sendSupportMessage() {
        const message = document.getElementById('supportMessage').value;
        if (message.trim() === '') {
            alert('Kérjük, írja be a kérdését!');
            return;
        }

        // AJAX kérés küldése a PHP backendhez
        fetch('support_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sszoveg: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('A kérdése sikeresen elküldve!');
                document.getElementById('supportMessage').value = '';
                toggleSupportPopup();
            } else {
                alert('Hiba történt az üzenet elküldésekor.');
            }
        })
        .catch(err => console.error(err));
    }

    // Üzenetek frissítése
    function fetchMessages() {
        fetch('fetch_messages.php')
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    const messageContainer = document.getElementById('messages');
                    messageContainer.innerHTML = ''; // Az eddigi üzenetek törlése
                    data.messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'message';
                        messageElement.textContent = message.sszoveg + ' - ' + message.username;
                        messageContainer.appendChild(messageElement);
                    });
                }
            })
            .catch(err => console.error('Hiba történt az üzenetek lekérésekor:', err));
    }

    // Polling (5 másodpercenként)
    setInterval(fetchMessages, 5000);


</script>
<?php
    if (isset($_GET['p'])) $p=$_GET['p']; else $p="";
    if (!isset($_SESSION['uid'])) {
        if ($p == "")                       include("kezdolap.php");
        else if ($p == "reg")               include("regisztracio.php");
        else if ($p == "login")             include("login_form.php");
        else if ($p == "konyvek")           include("konyvek.php");
        else if ($p == "konyvreszletek")    include("konyv_reszletek.php");
        else if ($p == "kosar")             include("kosar.php");
        else                                include("404.php");
    } else {
        if ($p == "")                       include("kezdolap.php");
        else if ($p == "konyvek")           include("konyvek.php");
        else if ($p == "adatlapom")         include("fiok.php");
        else if ($p == "adatmodositas")     include("adatlap_modositas.php");
        else if ($p == "jelszomodositas")   include("jelszomodositas.php");
        else if ($p == "konyv_lista")       include("konyv_lista.php");
        else if ($p == "konyvreszletek")    include("konyv_reszletek.php");
        else if ($p == "kosar")             include("kosar.php");
        else                                include("404.php");
    }
?>
<iframe name="kisablak"></iframe>
<footer>
    <p>&copy; 2024 Bookli.hu Minden jog fenntartva.</p>
    <?php var_dump($_SESSION['uid']);?>
</footer>
</body>
</html>