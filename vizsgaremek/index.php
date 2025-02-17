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
    ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
</head>
<body>
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
    footer{
        text-align:center;
    }

    /* Main content styling */
    .main-content {
        text-align: center;
        margin-top: 50px;
        flex: 1;
    }   
    h1 {
        color: #ff6b6b;
        font-size: 36px;
        margin-bottom: 20px;
    }   
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
        if ($p == "")                   include("kezdolap1.php");
        else if ($p == "reg")           include("regisztracio.php");
        else if ($p == "login")         include("login_form.php");
        else                            include("404.php");
    } else {
        if ($p == "")                       include("belsolap.php");
        else if ($p == "adatlapom")         include("adatlap_form.php");
        else if ($p == "jelszomodositas")   include("jelszomodositas.php");
        else if ($p == "konyv_lista")       include("konyv_lista.php");
        else if ($p == "konyvreszletek")    include("konyv_reszletek.php");
        else if ($p == "kedvencek")         include("kedvencek.php");
        else if ($p == "kosar")             include("kosar.php");
        else                                include("404.php");
    }
?>
<iframe name="kisablak"></iframe>
<footer>
    <p>&copy; 2024 Bookli.hu. Minden jog fenntartva.</p>
</footer>
</body>
</html>