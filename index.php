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
    <title>Robin Wilmes</title>
</head>
<body>

    <div class="slide" id="home">
        <div class="wrapper">

            <img src="images/portfolio/Portfolio.svg" alt="Portfolio Robin Wilmes" id="portfolio">

            <nav>
                <ul>
                    <li><a href="#presentation">A propos</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>

            <div class="bouton"><a href="#presentation">Me découvrir</a></div>
            
            <div class="bloc_texte">
                <img src="images/portfolio/Logo.svg" alt="Logo Robin Wilmes" id="logo">
                <h1>Robin Wilmes</h1>
                <h3>Graphiste - Infographiste</h3>
            </div>

            <!-- <div class="fleche"></div> -->

        </div>
    </div>

    <!-- --------------------------------------------- -->

    <div class="slide2" id="presentation">
        <div class="wrapper">
            <div class="wrapper2">

                <h1>A propos</h1>

                <p>Bienvenue sur mon Portfolio. Je suis Robin Wilmes et ce site web est dédié à mon travail et à mes réalisations dans le domaine de l'infographie.</p>

                <h3>Compétences</h3>

                <img src="images/portfolio/Photoshop.png" alt="Logo Photoshop" id="competence">
                <img src="images/portfolio/Illustrator.png" alt="Logo Illustrator" id="competence">
                <img src="images/portfolio/InDesign.png" alt="Logo InDesign" id="competence">
                <img src="images/portfolio/Animate.png" alt="Logo Animate" id="competence">
                <img src="images/portfolio/AfterEffect.png" alt="Logo AfterEffect" id="competence">
                <img src="images/portfolio/Audition.png" alt="Logo Audition" id="competence">
                <img src="images/portfolio/Figma.png" alt="Logo Figma" id="competence">
                <img src="images/portfolio/Html.png" alt="Logo Html" id="competence">
                <img src="images/portfolio/Css.png" alt="Logo Css" id="competence">
                <img src="images/portfolio/Php.png" alt="Logo Php" id="competence">

            </div>

            <div class="wrapper3">
                <img src="images/portfolio/Oeil.svg" alt="Robin Wilmes" id="oeil">

            </div>

        </div>
    </div>

    <!-- --------------------------------------------- -->

    <div class="slide3" id="galerie">
        <div class="wrapper">

            <!-- <img src="images/portfolio/Portfolio.svg" alt="Portfolio Robin Wilmes" id="portfolio"> -->

            <h1>Galerie</h1>
            
            <div id="container-products">

                <?php
                    $req = $bdd->query("SELECT * FROM products ORDER BY date DESC LIMIT 0, 4");
                    while($don = $req->fetch())
                    {
                        //var_dump($don);
                        echo "<a class='products' href='products.php?id=".$don['id']."'>";
                            echo "<img src='images/bdd/".$don['cover']."' alt='image de ".$don['title']."'>";
                            // echo "<div class='prod-title'>".$don['title']."</div>";
                        echo "</a>";
                    }
                    $req->closeCursor();
                ?>

            </div> 
            
            <a href="products.php">En voir plus</a>

        </div>
    </div>

    <!-- --------------------------------------------- -->

    <div class="slide4" id="contact">
        <div class="wrapper">

            <h1>Me contacter</h1>
            <form action="traitement.php" method="POST" id="my-form">
                <?php
                    if(isset($_GET['add']))
                    {
                        echo "<div class='success'>Votre message a bien été envoyé</div>";
                    }
                ?>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom">
                    <div class="invalid-feedback">
                        Veuillez ajouter un nom
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
                    <div class="invalid-feedback">
                        Veuillez ajouter une adresse E-mail
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"></textarea>
                    <div class="invalid-feedback">
                        Veuillez ajouter un message
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

            <div class="footer">
                <footer>
                    <ul class="list-inline">
                        <li><a href="#home">Accueil </a> | <a href="#presentation"> A propos</a> | <a href="#galerie"> Galerie </a> | <a href="legal.php"> Politique de confidentialité</a></li>
                    </ul>
                    <p class="copyright">Robin Wilmes © 2023</p>
                </footer>
            </div>

            <img src="images/portfolio/Plantes.svg" alt="Robin Wilmes" id="plantes">

        </div>
    </div>

</body>
</html>