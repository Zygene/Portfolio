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

            <button class="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
            </button>

            <ul class="menu">
                <li><a class="menuNav" href="#home">Accueil</a></li>
                <li><a class="menuNav" href="#presentation">A propos</a></li>
                <li><a class="menuNav" href="#galerie">Galerie</a></li>
                <li><a class="menuNav" href="#contact">Contact</a></li>
            </ul>

            <script>
                const menu = document.querySelector(".menu");
                const menuNav = document.querySelectorAll(".menuNav");
                const hamburger= document.querySelector(".hamburger");
                const closeNav= document.querySelector(".closeNav");
                const bar = document.querySelectorAll(".bar");

                function toggleMenu() {
            menu.classList.toggle("showMenu");
            hamburger.classList.toggle("open");

            if (menu.classList.contains("showMenu")) {
                for (let bar of bars) {
                    bar.style.transform = "translateX(-50%)";
                    bar.style.opacity = "0";
                }
            } else {
                for (let bar of bars) {
                    bar.style.transform = "translateX(-50%)";
                    bar.style.opacity = "1";
                }
            }
        }

                hamburger.addEventListener("click", toggleMenu);

                menuNav.forEach( 
                    function(menuNav) { 
                    menuNav.addEventListener("click", toggleMenu);
                })

            </script>

            <!-- <nav>
                <ul>
                    <li><a href="#presentation">A propos</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav> -->
            
            <div class="wrapper2">
                <img src="images/portfolio/Logo.svg" alt="Logo Robin Wilmes" id="logo">
                <div class="bloc">
                    <h1>Robin Wilmes</h1>
                    <h3>Graphiste - Infographiste</h3>
                </div>
            </div>
            
            <div class="bouton"><a href="#presentation">Me découvrir</a></div>

        </div>
    </div>

    <!-- --------------------------------------------- -->

    <div class="slide2" id="presentation">
        <div class="wrapper">
            <div class="wrapper2">

                <h1>A propos</h1>

                <p>Bienvenue sur mon Portfolio. Je suis Robin Wilmes et je suis étudiant dans le domaine de l'infographie. Je suis constamment à la recherche de nouvelles idées et de nouvelles inspirations pour créer des infographies qui se démarquent et qui communiquent efficacement</p>

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
                <img src="images/portfolio/Blender.png" alt="Logo Blender" id="competence">

            </div>

            <div class="wrapper3">
                <img src="images/portfolio/Oeil.svg" alt="Robin Wilmes" id="oeil">

            </div>

        </div>
    </div>

    <!-- --------------------------------------------- -->

    <div class="slide3" id="galerie">
        <div class="wrapper">

            <h1>Galerie</h1>

            <div class="wrapper2">
                
                <div id="illustr">
                    <h2><a href="illustrations.php">Illustrations</a></h2>
                    <a href="illustrations.php"><img src="images/portfolio/sentiment.jpg" alt=""></img></a>
                </div>

                <div id="misenp">
                    <h2><a href="mep.php">Mise en page</a></h2>
               <a href="mep.php"><img src="images/portfolio/typo.jpg" alt=""></img></a>
                </div>

                <div id="anim">
                    <h2><a href="animations.php">Animations</a></h2>
                 <a href="animations.php"><img src="images/portfolio/soleil.jpg" alt=""></img></a>
                </div>

            </div>

                

            </div>

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
                        echo "<div class='error'>Veuillez remplir le formulaire correctement</div>";
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