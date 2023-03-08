<?php
try
{
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost;dbname=we_love_food;charset=utf8', 'root', 'root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
?>