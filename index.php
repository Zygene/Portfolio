<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Robin Wilmes</title>
</head>
<body>

<h1>Stock</h1>
    <div class="slide" id="home">
        <div id="container-products">
            <?php
                $req = $bdd->query("SELECT * FROM products ORDER BY date DESC LIMIT 0, 3");
                while($don = $req->fetch())
                {
                    //var_dump($don);
                    echo "<a class='products' href='product.php?id=".$don['id']."'>";
                        echo "<img src='images/mini_".$don['cover']."' alt='image de ".$don['title']."'>";
                        echo "<div class='prod-title'>".$don['title']."</div>";
                    echo "</a>";
                }
                $req->closeCursor();
            ?>
        </div> 
        <a href="products.php">Voir plus</a>
    </div>
    <div class="slide" id="contact">
        <div class="wrapper">
            <h2>Contact</h2>
            <form action="traitement.php" method="POST" id="my-form">
                <?php
                    if(isset($_GET['add']))
                    {
                        echo "<div class='success'>Votre message a bien été envoyé</div>";
                    }
                ?>
                <div class="form-group">
                    <label for="nom">Nom: </label>
                    <input type="text" name="nom" id="nom">
                    <div class="invalid-feedback">
                        Veuillez remplir le champ nom correctement
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" id="email">
                    <div class="invalid-feedback">
                        Veuillez remplir le champ adresse e-mail correctement
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="message" id="message"></textarea>
                    <div class="invalid-feedback">
                        Veuillez remplir le champ message correctement
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Envoyer">
                </div>

                <?php
                    if(isset($_GET['error']))
                    {
                        echo "<div class='error'>Une erreur est survenue</div>";
                    }
                ?>

            </form>
        </div>
    </div>

</body>
</html>