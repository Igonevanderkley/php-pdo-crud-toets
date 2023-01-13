<?php 
//configuratie gegevens toevoegen
require 'config.php';

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    if ($pdo) {
        //echo "Verbinding is gelukt";
    } else {
        echo "interne server-error";
    }
} catch(PDOException $e) {
    $e->getMessage();
}

//De delete query
$sql = "DELETE FROM DureAuto
        WHERE Id = :Id";

//voorbereiden
$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

//executeren
$result = $statement->execute();

if ($result) {
    echo "Het record is succesvol verwijderd";
    header('Refresh:3; url=read.php');
} else {
    echo "Het record is niet verwijderd";
    header('Refresh:3; url=read.php');
}