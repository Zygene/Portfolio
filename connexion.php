<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=portfolio;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur: '.$e->getMessage());
    }
?>


<!-- Interchanger -->

<!-- $bdd = new PDO('mysql:host=localhost;dbname=portfolio;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); -->
<!-- $bdd = new PDO('mysql:host=localhost;dbname=wiro7259_portfolio_stock;charset=utf8','wiro7259_Zygene','V5Vr-dB9B-wxV)',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); -->


<!-- Mdp O2Switch : V5Vr-dB9B-wxV) -->


<!-- Github -->

<!-- git add .
     git commit -a -m "ton message"
     git push -->