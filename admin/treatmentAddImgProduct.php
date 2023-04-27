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
     $req = $bdd->prepare("SELECT * FROM products WHERE id=?");
     $req->execute([$id]);
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:products.php");
     }
     $req->closeCursor();

     if(isset($_FILES['image']))
     {
        if(empty($_FILES['image']['tmp_name']))
        {
            header("LOCATION:addImgProduct.php?id=".$id."&error=4");
        }else{

            $dossier = "../images/"; // ../images/monfichier.jpg
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
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
                    $insert = $bdd->prepare("INSERT INTO images(fichier,id_products) VALUES(:fichier,:idprod)");
                    $insert->execute([
                        ":fichier"=> $fichiercptl,
                        ":idprod"=> $id
                    ]);
                    $insert->closeCursor();
                    header("LOCATION:updateProduct.php?id=".$id."&galimg=success");
                }else{
                    header("LOCATION:addImgProduct.php?id=".$id."&error=5");
                }
            }else{
                header("LOCATION:addImgProduct.php?id=".$id."&error=".$erreur);
            }

        }
     }else{
        header("LOCATION:products.php");
     }

?>