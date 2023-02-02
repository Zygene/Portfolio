<!DOCTYPE html>
<html lang="fr">
<?php
    session_start();
    require "../connexion.php";

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    // formulaire déjà envoyé ou non
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        // si vide ou non
       if(empty($_POST['login']) OR empty($_POST['password']))
       {
        $error = "Remplir le formulaire";
       }else{
            // traitement du login et mot passe
            $login = htmlspecialchars($_POST['login']);
            $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                // login existe
                // vérifier mot de passe
                if(password_verify($_POST['password'],$don['password']))
                {
                    // ok connexion
                    $_SESSION['login'] = $don['login'];
                    $req->closeCursor();
                    header("LOCATION:dashboard.php");
                }else{
                    // mot de passe incorrect
                    $error = "Mot de passe incorrect";
                }
            }else{
                // login n'existe pas
                $error = "Identifiant / Mot de passe incorrect";
            }
            $req->closeCursor();
       }
    }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Administration</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-4 my-5">
                <h1 class="col-4 pb-3 text-center">Connexion</h1>
                <?php
                if(isset($error))
                {
                    echo "<div class='alert alert-danger col-4 text-center'>".$error."</div>";
                }

                ?>
                <form action="index.php" method="POST">
                    <div class="form-group my-2 col-4 text-center">
                        <label for="login" class="pb-2">Identifiant</label>
                        <input type="text" id="login" name="login" class="form-control">
                    </div>
                    <div class="form-group col-4 text-center">
                        <label for="password" class="pb-2">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <input type="submit" value="Se connecter" class="btn btn-dark text-white col-2">
                        <a href="../index.php" class="btn btn-secondary col-2">Retour au site</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>