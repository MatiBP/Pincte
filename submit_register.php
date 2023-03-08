<?php
require_once 'db.php';

if(!isset($_SESSION['LOGGED_USER'])){
    header('Location: home.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email= $_POST['email'];
    $password= $_POST['password'];
    $full_name= $_POST['full_name'];
    $age = $_POST['age'];

    $sqlQuery = "INSERT INTO `users`(`full_name`, `email`, `password`, `age`) VALUES ('$full_name','$email','$password','$age')";
    $registeryStatement = $mysqlClient->prepare($sqlQuery);
    $registeryStatement->execute();

    header("Location: home.php");
    exit;
}else{
    echo "erreur lors de l'enregistrement";
}

?>