<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
    </head>
    

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php include_once('includes/header.php'); ?>

        <!-- Formulaire de connexion -->
        <?php include_once('login.php'); ?>
        
        
        <?php
        require_once 'db.php';

        // Si tout va bien, on peut continuer

        // On récupère tout le contenu de la table recipes
        $sqlQuery = 'SELECT * FROM recipes WHERE is_enabled=true';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        
        ?>

        <?php if(isset($_SESSION['LOGGED_USER'])): ?>
        <h1>Site de recettes</h1>

        <?php foreach ($recipes as $recipe) : ?>
            
            <article>
                <h3><?php echo $recipe['title']; ?></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo $recipe['author']; ?></i>
            </article>
            
        <?php endforeach ?>
        <?php endif; ?>
        </div>
          

        <!-- inclusion du bas de page du site -->
        <?php include_once('includes/footer.php'); ?>
    </body>
</html>