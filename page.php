<?php 
session_start();
require_once 'db.php';


if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: home.php');
    exit;
}

$sqlQuery = 'SELECT * FROM pages WHERE user_id = :connected_id';
$pagesStatement = $mysqlClient->prepare($sqlQuery);
$pagesStatement->bindParam(':connected_id', $_SESSION['LOGGED_USER']['user_id']);
$pagesStatement->execute();

// Récupérer les données binaires de l'image
$pages = $pagesStatement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container">
    <?php include_once('includes/header.php'); ?>
    <h1>Page utilisateur</h1>

    <form action="add_picture.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="picture" class="form-label">Add your picture</label>
            <input type="file" class="form-control" id="picture" name="picture"/>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <br/>


<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($pages as $page) : ?>
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top img-fluid" src="print_picture.php?picture_id=<?php echo $page['picture_id'];?>" alt="Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $page['picture_name'];?></h5>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php include_once('includes/footer.php');?>

</body>
</html>
