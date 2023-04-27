<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    //vérifier la prés de id
    if(isset($_GET['id']))
    {
        $id = htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:products.php");
    }

     // vérifier si l'id est dans la bdd
     require "../connexion.php";
     $req = $bdd->prepare("SELECT * FROM products WHERE id=?");
     $req->execute([$id]);
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:products.php");
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
    <title>Administration de la galerie</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        include("partials/header.php");
    ?>
    <div class="container">
        <h2>Ajouter une image à <?= $don['title'] ?></h2>
        <form action="treatmentAddImgProduct.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group my-3">
                <label for="image">Image de galerie: </label>
                <input type="file" name="image" id="image" class="form-control">
            </div>


            <div class="form-group my-3">
                <input type="submit" value="Ajouter" class="btn btn-success">
                <a href="updateProduct.php?id=<?= $id ?>" class="btn btn-secondary">Retour</a>
            </div>
        </form>
        <?php
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-danger my-2'>Une erreur est survenue (code: ".$_GET['error'].")</div>";
            }
        ?>
    </div>
</body>
</html>