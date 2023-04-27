<?php
    require "connexion.php";
    $limit= 3;
    $reqcount = $bdd->query("SELECT * FROM products");
    $count = $reqcount->rowCount();
    $nbpage = ceil($count/$limit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div id="container-products">
        <?php
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
                    echo " &nbsp;<a href='products.php?page=".($pg-1)."' title='Page précédente'> < </a>";
                }
                echo "Page ".$pg." ";
                if($pg!=$nbpage && $pg<$nbpage)
                {
                    echo " &nbsp;<a href='products.php?page=".($pg+1)."' title='Page suivante'> > </a>";
                }
            echo "</div>";

        ?>


        <?php
            $req = $bdd->prepare("SELECT * FROM products ORDER BY date DESC LIMIT :offset , :mylimit");
            $req->bindParam(':offset',$offset, PDO::PARAM_INT);
            $req->bindParam(":mylimit", $limit, PDO::PARAM_INT);
            $req->execute();
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
</body>
</html>