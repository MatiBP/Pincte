<?php 
session_start();
require_once 'db.php';

if (!isset($_GET['picture_id'])) {
    header('Location: page.php');
    exit;
}

$picture_id = $_GET['picture_id'];

$sqlQuery = 'SELECT picture FROM pages WHERE picture_id = :picture_id AND user_id = :connected_id';
$pagesStatement = $mysqlClient->prepare($sqlQuery);
$pagesStatement->bindParam(':picture_id', $picture_id);
$pagesStatement->bindParam(':connected_id', $_SESSION['LOGGED_USER']['user_id']);
$pagesStatement->execute();

$page = $pagesStatement->fetch();

// Spécifier le type de contenu retourné par le script
header('Content-Type: image/jpeg');

// Afficher l'image
echo $page['picture'];
?>
