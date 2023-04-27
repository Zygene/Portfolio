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

    // s'il vient de mon form ou non
    if(isset($_POST['title']))
    {
        // vérif du contenu du formulaire et gestion error
        // init d'une variable $err à 0 
        $err = 0;
        $description = $_POST['description'];

        if(empty($_POST['title']))
        {
            $err = 1;
        }else{
            $title = htmlspecialchars($_POST['title']);
        }

        if(is_numeric($_POST['categorie']))
        {
            $categorie = htmlspecialchars($_POST['categorie']);
        }else{
            $err = 2;
        }

        if(empty($_POST['date']))
        {
            $err = 3;
        }else{
            $date = htmlspecialchars($_POST['date']);
        }


        //vérif si err sinon traitement
        if($err==0){

            if(empty($_FILES['image']['tmp_name']))
            {
                // pas d'image, donc modif sans fichier
                $update = $bdd->prepare("UPDATE products SET title=:titre, date=:date, description=:description, id_categorie=:categorie WHERE id=:myid");
                $update->execute([
                    ":titre" => $title,
                    ":categorie"=>$categorie, 
                    ":date" => $date, 
                    ":description" => $description, 
                    ":myid" => $id
                ]);
                $update->closeCursor();
                header("LOCATION:products.php?updatesuccess=".$id);
            }else{
                // traitement de l'image pour la modification
                $dossier = "../images/bdd/"; // ../images/monfichier.jpg
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 5000000;
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
                        // supprimer le fichier de base
                        unlink("../images/bdd/".$don['cover']);
                        // ne pas oublier la miniature
                        unlink("../images/bdd/mini_".$don['cover']);
                        $update = $bdd->prepare("UPDATE products SET title=:titre, date=:date, description=:description, id_categorie=:categorie, cover=:image WHERE id=:myid");
                        $update->execute([
                            ":titre" => $title, 
                            ":categorie"=>$categorie,
                            ":date" => $date, 
                            ":description" => $description, 
                            ":image"=>$fichiercptl,
                            ":myid" => $id
                        ]);
                        $update->closeCursor();
                        // tester l'extension pour envoyer vers le bon fichier de redim et envoyer que c'est une modification avec l'id du produit à modif
                        if($extension==".png")
                        {
                            header("LOCATION:redimpng.php?update=".$id."&image=".$fichiercptl);
                        }else{
                            header("LOCATION:redim.php?update=".$id."&image=".$fichiercptl);
                        }
                    }else{
                        header("LOCATION:updateProduct.php?id=".$id."&errorimg=3");
                    }             
                }else{
                    header("LOCATION:updateProduct.php?id=".$id."&errorimg=".$erreur);
                }

            }
        }else{
            header("LOCATION:updateProduct.php?id=".$id."&error=".$err);
        }

    }else{
        header("LOCATION:products.php");
    }

?>