<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adatmódosítás</title>
<style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .relog {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            padding: 20px; 
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px; 
            width: 90%; 
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 15px;
            animation: fadeIn 0.8s ease;
            margin: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #333;
            font-size: 22px; 
            font-weight: 600;
            margin-bottom: 15px;
        }

        label {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
            text-align: left;
            display: block;
        }

        .relog input[type="text"],
        .relog input[type="email"],
        .relog input[type="tel"],
        .relog input[type="date"],
        .relog input[type="file"] {
            width: 100%;
            padding: 10px; 
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: border 0.3s, box-shadow 0.3s;
        }

        .relog input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .name-container {
            display: flex;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .name-container div {
            flex: 1;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            text-align: left;
        }

        .profile-container img {
            width: 60px; 
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .relog input[type="submit"], input[type="button"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 8px;
        }

        .relog input[type="submit"] {
            background-color: #4a90e2;
        }

        .relog input[type="submit"]:hover {
            background-color: #357ab7;
            transform: translateY(-2px);
        }

        #jmodositas {
            background-color: #ff7675;
        }

        #jmodositas:hover {
            background-color: #d65c5c;
            transform: translateY(-2px);
        }

        @media (max-width: 480px) {
            form {
                padding: 15px;
            }
            .name-container {
                flex-direction: column;
            }
        }
</style>
</head>
<body>
    <?php
    include("kapcsolat.php");
    $user = mysqli_fetch_array(mysqli_query($adb,"SELECT * FROM user WHERE uid ='$_SESSION[uid]'"));
    $profkep = !empty($user['uprofkepnev_eredetinev']) ? "./profilkepek/" . $user['uprofkepnev_eredetinev'] : "./profilkepek/picon2.png";
    ?>

    <form action='adatlap_ir.php' method='post' target='kisablak' class='relog' enctype='multipart/form-data'>
        <h2>Adatok Módosítása</h2>
        
        <div class="profile-container">
            <img src="<?= htmlspecialchars($profkep); ?>" alt="Profilkép">
            <div>
                <label for="profkep">Profilkép:</label>
                <input type="file" name="profkep" id="profkep">
            </div>
        </div>
        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['uemail']); ?>">
        <input type="submit" value="Adatok módosítása">
        <a href="./?p=jelszomodositas"><input type="button" id="jmodositas" name="jmodositas" value="Jelszó módosítása"></a>
        <input type="hidden" name="uid" id="uid" value="<?= htmlspecialchars($user['uid']); ?>">
    </form>
</body>
</html>
