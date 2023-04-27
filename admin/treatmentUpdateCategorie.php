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
     $req = $bdd->prepare("SELECT * FROM categorie WHERE id=?");
     $req->execute([$id]);
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:categorie.php");
     }
     $req->closeCursor();

    // s'il vient de mon form ou non
    if(isset($_POST['nom']))
    {
        // vérif du contenu du formulaire et gestion error
        // init d'une variable $err à 0 
        $err = 0;
        if(empty($_POST['nom']))
        {
            $err = 1;
        }else{
            $nom = htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['description']))
        {
            $err = 3;
        }else{
            $description = htmlspecialchars($_POST['description']);
        }

        //vérif si err sinon traitement
        if($err==0){
            require "../connexion.php";
            $update = $bdd->prepare("UPDATE categorie SET nom=?, description=? WHERE id=?");
            $update->execute([$nom,$description,$id]);
            $update->closeCursor();
            header("LOCATION:categorie.php?update=".$id);
        }else{
            header("LOCATION:addCategorie.php?error=".$err);
        }

    }else{
        header("LOCATION:categorie.php");
    }

?>