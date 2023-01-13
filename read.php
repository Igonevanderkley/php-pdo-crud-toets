<?php
//configuratie gegevens toevoegen
require 'config.php';

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        //echo "De verbinding is gelukt";

    } else {
        echo "er is een interne server-error";
    }
} catch (PDOException $e) {
    echo $e->$getMessage();
}

//de gegevens ophalen uit de database
$sql = "SELECT * FROM DureAuto
ORDER BY Prijs desc";

//voorbereiden
$statement = $pdo->prepare($sql);

//executeren
$statement->execute();

// het resultaat in een array zetten
$result = $statement->fetchAll(PDO::FETCH_OBJ);



$rows = "";
foreach ($result as $info) {
    $rows .= "<tr>
                <td>$info->Merk</td>
                <td>$info->Model</td>
                <td>$info->Topsnelheid</td>
                <td>$info->Prijs</td>
                <td>
                <a href='delete.php?Id=$info->Id'>
                <img src='img/b_drop.png' alt='kruis'>
                </a>
                <tr>      
     ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>De vijf rijkste mensen ter wereld</h1>
    <br>
    <br>
    <table border='1'>
        <thead>
            <th>Merk</th>
            <th>Model</th>
            <th>Topsnelheid</th>
            <th>Prijs</th>
            <th></th>
            <t/head>
        <tbody>
            <?= $rows ?>
        </tbody>
    </table>
</body>

</html>