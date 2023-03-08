<?php 
    // Détruire la session existante
    session_start();
    session_destroy();
    
    // Rediriger l'utilisateur vers la page "home.php"
    header("Location: home.php");
    exit;
?>