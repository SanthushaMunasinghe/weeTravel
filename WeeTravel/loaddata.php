<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=travel_articles', 'root', '');//connection to the database
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>