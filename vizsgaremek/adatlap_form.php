<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatmódosítás</title>
    <style>
        /* Belsolap stílusok */
        body {
            font-family: Arial, sans-serif;
            background-color: #1d1f21;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: #2a2c2f;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        h2 {
            color: #ff6b6b;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #fd7015;
            margin-bottom: 5px;
            text-align: left;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #1d1f21;
            color: #e0e0e0;
            font-size: 14px;
        }

        input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-container img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        input[type="submit"], input[type="button"] {
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        input[type="submit"] {
            background-color: #4a90e2;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #357ab7;
            transform: translateY(-2px);
        }

        #jmodositas {
            background-color: #ff6b6b;
            color: white;
        }

        #jmodositas:hover {
            background-color: #e63946;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <?php
    include("kapcsolat.php");
    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT * FROM user WHERE uid ='$_SESSION[uid]'"));
    $profkep = !empty($user['uprofkepnev_eredetinev']) ? "./profilkepek/" . $user['uprofkepnev_eredetinev'] : "./profilkepek/alapprofilkep.jfif";
    ?>

    <form action='adatlap_ir.php' method='post' target='kisablak' enctype='multipart/form-data'>
        <h2>Adatok Módosítása</h2>
        
        <div class="profile-container">
            <img src="<?= htmlspecialchars($profkep); ?>" alt="Profilkép">
            <div>
                <label for="profkep">Profilkép:</label>
                <input type="file" name="profkep" id="profkep">
            </div>
        </div>

        <label for="keresztnev">Keresztnév:</label>
        <input type="text" name="keresztnev" id="keresztnev" value="<?= htmlspecialchars($user['ufirstname']); ?>">

        <label for="vezeteknev">Vezetéknév:</label>
        <input type="text" name="vezeteknev" id="vezeteknev" value="<?= htmlspecialchars($user['ulastname']); ?>">

        <label for="szuldatum">Születési dátum:</label>
        <input type="date" name="szuldatum" id="szuldatum" value="<?= htmlspecialchars($user['uszuldatum']); ?>">

        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['uemail']); ?>">

        <input type="submit" value="Adatok módosítása">
        <input type="button" id="jmodositas" name="jmodositas" value="Jelszó módosítása" onclick="openPasswordChange()">
        <input type="hidden" name="uid" value="<?= htmlspecialchars($user['uid']); ?>">
    </form>

    <script>
        function openPasswordChange() {
            window.location.href = 'jelszomodositas.php';
        }
    </script>
</body>
</html>
