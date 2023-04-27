<?php
    // vérif si formulaire envoyé ou non
    if(isset($_POST['nom']))
    {
        // ok pour le formulaire
        // vérification des données
        $err=0;

        if(empty($_POST['nom']))
        {
            $err=1;
        }else{
            $nom = htmlspecialchars($_POST['nom']);
        }

        if(empty($_POST['email']))
        {
            $err=2;
        }else{
            $email = htmlspecialchars($_POST['email']);
        }

        if(empty($_POST['message']))
        {
            $err=3;
        }else{
            $message = htmlspecialchars($_POST['message']);
        }

        if($err==0)
        {
            // insert dans la bdd
            require "connexion.php";
            $insert = $bdd->prepare("INSERT INTO contact(nom,email,message,date) VALUES(:nom,:email,:message,NOW())");
            $insert->execute([
                ':nom'=>$nom,
                ":email"=>$email,
                ":message"=>$message
            ]);
            $insert->closeCursor();
            header("LOCATION:index.php?add=success#contact");
        }else{
            header("LOCATION:index.php?error=".$err."#contact");
        }


    }else{
        // n'est pas venu du formulaire
        header("LOCATION:index.php");
    }



?>