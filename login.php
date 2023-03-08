<?php
require_once 'db.php';
// retenir l'email de la personne connectée pendant 1 an
/*setcookie(
    'LOGGED_USER',
    'utilisateur@exemple.com',
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
);*/?>

<?php
    
    $sqlQueryUsers = 'SELECT * FROM users';
    $usersStatement = $mysqlClient->prepare($sqlQueryUsers);
    $usersStatement->execute();
    $users = $usersStatement->fetchAll()
?>

<?php

// Validation du formulaire
if (isset($_POST['email']) &&  isset($_POST['password'])) {

    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            //enregistrement email utilisateur SESSION
            $_SESSION['LOGGED_USER'] = $user;
            
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
?>

<?php if(!isset($_SESSION['LOGGED_USER'])): ?>
<form action="home.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <h2>Connexion</h2>
        <form action="submit_login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">email</label><br>
            <input type="email" class="form-login" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com"><br>
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="col-sm-2 col-form-label">password</label><br>
            <input type="password" class="form-login" id="password" name="password" ><br>
        </div> 

            <input type="submit" value="Se connecter" class="btn btn-primary mb-3">
        </form>
<?php else: ?>
    <div class="alert alert-success" role="alert">
    "Bonjour <?php echo $_SESSION['LOGGED_USER']['full_name']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>


    

