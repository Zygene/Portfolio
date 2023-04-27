<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";

    if(isset($_GET['delete']))
    {
        $verif = $bdd->prepare("SELECT * FROM categorie WHERE id=?");
        $verif->execute([$_GET['delete']]);
        if(!$donVerif = $verif->fetch())
        {
            $verif->closeCursor();
            header("LOCATION:categorie.php");
        }
        $verif->closeCursor();

        $update = $bdd->prepare("UPDATE products SET id_categorie=0 WHERE id_categorie=?");
        $update->execute([$_GET['delete']]);
        $update->closeCursor();

        $delete = $bdd->prepare("DELETE FROM categorie WHERE id=?");
        $delete->execute([$_GET['delete']]);
        $delete->closeCursor();
        header("LOCATION:categorie.php?delsuccess=".$_GET['delete']);
    }

   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Portfolio: Admin - Catégories</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
        include("partials/header.php");
    ?>
    <div class="container col-8">
        <div class="mb-3">
            <h1 class="my-3">Catégories</h1>
                <div>
                    <a href="addCategorie.php" class="btn btn-primary my-2">Ajouter</a>
                    <a href="dashboard.php" class="btn btn-secondary">Retour</a>
                </div>
            </div>
        <?php 
            if(isset($_GET['delsuccess']))
            {
                echo "<div class='alert alert-danger my-3'>Vous avez supprimer la catégorie n°".$_GET['delsuccess']."</div>";
            }
            if(isset($_GET['add']))
            {
                echo "<div class='alert alert-success my-3'>Vous avez bien ajouté une catégorie</div>";
            }
            if(isset($_GET['update']))
            {
                echo "<div class='alert alert-warning my-3'>Vous avez bien modifié la catégorie n°".$_GET['update']."</div>";
            }

        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class='text-center'>Id</th>
                    <th class='text-center'>Nom</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $req = $bdd->query("SELECT * FROM categorie ORDER BY nom ASC");
                    while($don = $req->fetch())
                    {
                        echo "<tr>";
                            echo "<td class='text-center'>".$don['id']."</td>";
                            echo "<td class='text-center'>".$don['nom']."</td>";
                            echo "<td class='text-center'>";
                            if($don['id']!=0)
                            {
                                echo "<a href='updateCategorie.php?id=".$don['id']."' class='btn btn-warning mx-2'>Modifier</a>";
                                echo "<a href='categorie.php?delete=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                            }
                            echo "</td>";
                        echo "</tr>";
                    }
                    $req->closeCursor();
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>