<?php
session_start();
require_once 'db.php';
include_once("includes/header.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    header("Location: login.php"); // rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit;
}


// Vérifier si l'utilisateur a soumis un formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vérifier si l'image a été téléchargée avec succès
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {

       
        // Obtenir le contenu binaire de l'image
        $image_data = file_get_contents($_FILES['picture']['tmp_name']);

        // Nom de l'image
        
        $picture_name = "picture of " . $_SESSION['LOGGED_USER']['full_name'];
        
    
        // ID de l'utilisateur connecté
        $user_id = $_SESSION['LOGGED_USER']['user_id'];

        // Nom de l'utilisateur connecté
        $user_name = $_SESSION['LOGGED_USER']['full_name'];

        // Requête SQL pour insérer l'image dans la base de données avec des paramètres préparés
        $sqlQuery = "INSERT INTO `pages`(`picture_name`, `picture`, `user_id`, `user_name`) VALUES (:picture_name, :image_data, :user_id, :user_name)";
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->bindParam(':picture_name', $picture_name);
        $statement->bindParam(':image_data', $image_data);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':user_name', $user_name);
        $statement->execute();
        

        // Rediriger vers la page de l'utilisateur après l'envoi réussi
        header("Location: page.php");
        exit;
    } else {
        // Si l'image n'a pas été téléchargée avec succès, afficher un message d'erreur
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>