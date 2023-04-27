<?php
    require "connexion.php";
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:404.php");
    }

    $req = $bdd->prepare("SELECT categorie.nom as cnom, categorie.description as cdescri, products.title as ptitle, DATE_FORMAT(products.date,'%d') AS day, DATE_FORMAT(products.date,'%m') AS month, DATE_FORMAT(products.date,'%Y') AS year, products.description as pdescri, products.cover as pcover FROM products INNER JOIN categorie ON products.id_categorie = categorie.id WHERE products.id=?");
    $req->execute([$id]);
    $don = $req->fetch();
    if(empty($don))
    {
        $req->closeCursor();
        header("LOCATION:404.php");
    }
    $req->closeCursor();

    $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h3 class='categorie'><?= $don['cnom'] ?></h3>
    <p><?= nl2br($don['cdescri']) ?></p>
    <h1 class="title"><?= $don['ptitle'] ?></h1>
    <div class="date">Le <?= $don['day'] ?> <?= $months[$don['month'] - 1] ?> <?= $don['year'] ?></div>
    <div class="description"><?= nl2br($don['pdescri']) ?></div>
    <div class="image">
        <img src="images/<?= $don['pcover'] ?>" alt="image de <?= $don['ptitle'] ?>">
    </div>
    <h2>Galerie</h2>
    <?php
        $galerie = $bdd->prepare("SELECT * FROM images WHERE id_products=?");
        $galerie->execute([$id]);
        $count = $galerie->rowCount(); // permet d'obtenir le nombre de réponse
        if($count > 0)
        {
            while($donGal = $galerie->fetch())
            {
                echo "<img src='images/".$donGal['fichier']."' alt='image de ".$don['ptitle']."'>";
            }
        }else{
            echo "Il n'y pas d'image supplémentaire pour ce produit";
        }
        $galerie->closeCursor();
    ?>
</body>
</html>