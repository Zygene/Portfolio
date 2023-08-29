<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=wiro7259_portfolio_stock;charset=utf8','wiro7259_Zygene','V5Vr-dB9B-wxV)',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur: '.$e->getMessage());
    }
?>