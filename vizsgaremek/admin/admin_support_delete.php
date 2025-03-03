<?php
    include("../kapcsolat.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $query = "UPDATE support SET stat = 0 WHERE supportid = '$id'";
        if (mysqli_query($adb, $query)) {
            echo "<script>alert('Sikeres üzenet törlés')</script>";
        } else {
            echo "<script>alert('Sikertelen üzenet törlés')</script>";
        }
        echo "<script>parent.location.href=parent.location.href</script>";
    }
?>