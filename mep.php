<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/icones/apple-touch-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icones/apple-touch-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icones/apple-touch-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icones/apple-touch-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icones/apple-touch-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icones/apple-touch-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icones/apple-touch-152px.png">
    <link rel="icon" type="image/png" href="/images/icones/favicon-196px.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/images/icones/favicon-160px.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/images/icones/favicon-96px.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/icones/favicon-32px.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/icones/favicon-16px.png" sizes="16x16">
    <link rel="mask-icon" href="/images/icones/safari-svg.svg" color="#000000">
    <link rel="stylesheet" href="style.css">
    <title>Robin Wilmes | Mise en page</title>
</head>
<body>
    
<div class="slide5">
    <div class="wrapper">
            
            <nav>
                <div class="wrapper2">
                    <h1>Mise en page</h1>
                </div>

                <ul>
                    <li><a href="index.php#galerie">Retour</a></li>
                </ul>
            </nav>

            <!-- ---------------------------------------------------- -->

            <div id="container-products">
                <!-- <?php
                    if(isset($_GET['page']))
                    {
                        $pg = $_GET['page'];
                    }else{
                        $pg = 1;
                    }

                    // (1-1)*3 = 0
                    // (2-1)*3 = 3
                    // (3-1)*3 = 6
                    $offset=($pg-1)*$limit; 

                    echo "<div id='pagination'>";
                        if($pg>1)
                        {
                            echo " &nbsp;<a href='illustrations.php?page=".($pg-1)."' title='Page précédente'> < </a>";
                        }
                        echo "Page ".$pg." ";
                        if($pg!=$nbpage && $pg<$nbpage)
                        {
                            echo " &nbsp;<a href='illustrations.php?page=".($pg+1)."' title='Page suivante'> > </a>";
                        }
                    echo "</div>";

                ?> -->


                <?php
                    // $req = $bdd->prepare("SELECT * FROM categorie WHERE EXISTS (SELECT * FROM products WHERE categorie.id = id_categorie)");
                    $req = $bdd->prepare("SELECT * FROM products INNER JOIN categorie ON products.id_categorie = categorie.id WHERE products.id_categorie=2");
                    // $req->bindParam(':offset',$offset, PDO::PARAM_INT);
                    // $req->bindParam(":mylimit", $limit, PDO::PARAM_INT);
                    $req->execute();
                    while($don = $req->fetch())
                    {
                        //var_dump($don);
                        echo "<a class='products' href='product.php?id=".$don['id']."' style='pointer-events: none;'>";
                            echo "<img src='images/bdd/".$don['cover']."' alt='image de ".$don['title']."'>";
                            echo "<div class='prod-title'>".$don['title']."</div>";
                        echo "</a>";
                    }
                    $req->closeCursor();
                ?>
            </div>

            <div class="footer">
                <footer>
                    <ul class="list-inline">
                        <li><a href="index.php#home">Accueil </a> | <a href="index.php#presentation"> A propos</a> | <a href="index.php#galerie"> Galerie </a> | <a href="legal.php"> Politique de confidentialité</a></li>
                    </ul>
                    <p class="copyright">Robin Wilmes © 2023</p>
                </footer>
            </div>
            
        </div>
    </div>

</body>