<?php

require_once "loaddata.php";//connection to header

$id = $_POST['id'] ?? null;//Get the post id if there is one

//just incase if there is not one redirect to home page
if (!$id) {
    header('Location: home.php');
    exit;
}

session_start();

$table = $_SESSION['currentTable'];//get the current table name

//Get information from the table
$statement = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$article = $statement->fetch(PDO::FETCH_ASSOC);

unlink($article['image']);//delete the image

//delete datails from the table
$statement = $pdo->prepare("DELETE FROM $table WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: home.php');//redirect to home page