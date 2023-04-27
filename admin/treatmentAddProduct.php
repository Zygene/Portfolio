<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

    // s'il vient de mon form ou non
    if(isset($_POST['nom']))
    {
        // vérif du contenu du formulaire et gestion error
        // init d'une variable $err à 0 
        $err = 0;
        $categorie = $_POST['categorie'];
        $title = $_POST['nom'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        
        if(empty($_POST['nom']))
        {
            $err = 1;
        }else{
            $title = htmlspecialchars($_POST['nom']);
        }
        
        if(empty($_POST['categorie']))
        {
            $err = 2;
        }else{
            if(is_numeric($_POST['categorie']))
            {
                $categorie = htmlspecialchars($_POST['categorie']);
            }else{
                $err = 3;
            }
        }
        
        if(empty($_POST['date']))
        {
            $err = 4;
        }else{
            $date = htmlspecialchars($_POST['date']);
        }

        //vérif si err sinon traitement
        if($err==0){
            $dossier = "../images/bdd/"; // ../images/monfichier.jpg
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 20000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = ['.png','.jpg','.jpeg'];
            $extension = strrchr($_FILES['image']['name'],'.');

            if(!in_array($extension, $extensions))
            {
                $erreur = 1;
            }
            
            if($taille>$taille_maxi){
                $erreur = 2;
            }

            if(!isset($erreur))
            {
                 // traitement
                 $fichier = strtr($fichier, 
                 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier); 
                $fichiercptl = rand().$fichier; 

                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichiercptl))
                {
                    require "../connexion.php";
                    $insert = $bdd->prepare("INSERT INTO products(nom,id_categorie,date,description,cover) VALUES(?,?,?,?,?)");
                    $insert->execute([$title,$categorie,$date,$description,$fichiercptl]);
                    $insert->closeCursor();
                    // tester l'extension pour envoyer vers le bon fichier de redim
                    if($extension==".png")
                    {
                        header("LOCATION:redimpng.php?image=".$fichiercptl);
                    }else{
                        header("LOCATION:redim.php?image=".$fichiercptl);
                    }

                }else{
                    header("LOCATION:addProduct.php?errorimg=3");
                }             
            }else{
                header("LOCATION:addProduct.php?errorimg=".$erreur);
            }


        }else{
            header("LOCATION:addProduct.php?error=".$err);
        }

    }else{
        header("LOCATION:products.php");
    }

?>