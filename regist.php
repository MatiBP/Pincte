<?php 
session_start();
if (isset($_SESSION['LOGGED_USER'])) {
    header('Location: home.php');
    exit;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class='container'>
        <?php include_once("includes/header.php"); ?>
        <form action="" method="POST">
            <h1>Enregistrement</h1>
            <label for="email" name="email" class="form-label">email</label>
            <input type="email" class="form-login" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com"><br>

            <label for="password" name="password" class="form-label">password</label>
            <input type="password" value="password" id="password" name="password" class="form-login"><br>
            <input type="submit" value="Se connecter" class="btn btn-primary mb-3">
        </form>
    </div>
</body>
</html>