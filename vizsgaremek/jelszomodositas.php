<?php 
    include("kapcsolat.php");
    $user = mysqli_fetch_array(mysqli_query($adb,'SELECT * FROM user WHERE uid ="$_SESSION[uid]"'));
    ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó Módosítása</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        h1 {
            text-align: center;
            font-size: 1.5em;
            color: #333;
        }

        label {
            font-size: 0.9em;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

   

    <form action="jelszomodositas_ir.php" method="post" target="kisablak">
        <h1>Jelszó Módosítása</h1>
        <div class="form-group">
            <label for="pw">Régi jelszó:</label>
            <input type="password" name="pw" id="pw" placeholder="Adja meg a régi jelszót">
        </div>
        <div class="form-group">
            <label for="pw2">Új jelszó:</label>
            <input type="password" name="pw2" id="pw2" placeholder="Új jelszó">
        </div>

        <input type="submit" value="Jelszó módosítása">

        <input type="hidden" name="uid" value="<?=$user['uid'];?>">
    </form>

</body>
</html>
