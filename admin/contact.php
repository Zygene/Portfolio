<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";

    if(isset($_GET['delete']))
    {
        $verif = $bdd->prepare("SELECT * FROM contact WHERE id=?");
        $verif->execute([$_GET['delete']]);
        if(!$donVerif = $verif->fetch())
        {
            $verif->closeCursor();
            header("LOCATION:contact.php");
        }
        $verif->closeCursor();

        $delete = $bdd->prepare("DELETE FROM contact WHERE id=?");
        $delete->execute([$_GET['delete']]);
        $delete->closeCursor();
        header("LOCATION:contact.php?delsuccess=".$_GET['delete']);
    }

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
    <div class="container col-8">
        <div class="mb-3">
            <h1 class="my-3">Contact</h1>

            <div>
                <a href="dashboard.php" class="btn btn-secondary my-2">Retour</a>
            </div>
        </div>
        <?php 
            if(isset($_GET['delsuccess']))
            {
                echo "<div class='alert alert-danger'>Vous avez supprimé le message n°".$_GET['delsuccess']."</div>";
            }

        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class='text-center'>Id</th>
                    <th class='text-center'>Nom</th>
                    <th class='text-center'>E-mail</th>
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $req = $bdd->query("SELECT id, nom, email, DATE_FORMAT(date, '%d/%m/%Y %Hh%i') as mydate FROM contact ORDER BY date DESC");
                    while($don = $req->fetch())
                    {
                        echo "<tr>";
                            echo "<td class='text-center'>".$don['id']."</td>";
                            echo "<td class='text-center'>".$don['nom']."</td>";
                            echo "<td class='text-center'>".$don['email']."</td>";
                            echo "<td class='text-center'>".$don['mydate']."</td>";
                            echo "<td class='text-center'>";
                                echo "<a href='message.php?id=".$don['id']."' class='btn btn-primary mx-2'>Afficher</a>";
                                echo "<a href='contact.php?delete=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
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