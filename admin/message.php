<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // vérifier s'il y a un GET id dans l'url
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:contact.php");
    }

    // vérifier que l'id a bien un correspondance dans la bdd
    require "../connexion.php";
    $req = $bdd->prepare("SELECT id, nom, email, message, DATE_FORMAT(date, '%d/%m/%Y %Hh%i') as mydate FROM contact WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:contact.php");
    }
    $req->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Portfolio: Admin - Contact</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
        include("partials/header.php");
    ?>
    <div class="container">
       <h3>Message de <?= $don['nom'] ?></h3>
       <h5>Envoyé le <?=  $don['mydate'] ?></h5>
       <h4>Adresse e-mail: <?= $don['email'] ?></h4>
        <div class="row">
            <div class="col">
                <?= nl2br($don['message']) ?>
            </div>
        </div>
        <div class="my-3">
            <a href="mailto:<?= $don['email'] ?>" class='btn btn-primary'>Répondre</a>
            <a href="contact.php" class="btn btn-secondary mx-2">Retour</a>
        </div>
    </div>
    
</body>
</html>