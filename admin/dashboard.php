<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    if(isset($_GET['deco']))
    {
        session_destroy();
        header("LOCATION:index.php");
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Administration</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <?php 
        include("partials/header.php");
    ?>

    <div class="container">
        <h1>Administration</h1>
        <div>
            <a href="products.php">Gestion des produits</a>
        </div>
    </div>
</body>
</html>