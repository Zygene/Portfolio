<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // déconnexion 
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
    <title>Portfolio: Admin - Menu</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #EFE5DF">
    <?php 
        include("partials/header.php");
    ?>
    <div class="container-fluid text-center form-group">
        <h1 class="my-3">Administration</h1>

        <div class="my-5" style="font-weight: 700">
            <a href="products.php" class="mx-5" style="color: #530E33; text-decoration: none">Gestion de la galerie</a>
            <a href="categorie.php" class="mx-5" style="color: #530E33; text-decoration: none">Gestion des catégories</a>
            <a href="contact.php" class="mx-5" style="color: #530E33; text-decoration: none">Gestion des contact</a>
        </div>

        <div class="my-5">
            <a href="dashboard.php?deco=ok" style="color: #530E33; text-decoration: none">Déconnexion</a>
        </div>
    </div>
</body>
</html>