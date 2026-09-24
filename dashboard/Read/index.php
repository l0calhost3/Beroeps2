<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


$db = new PDO('sqlite:../CRUD-DB.sqlite');

$ID=$_GET['ID'];

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = $db->QUERY('SELECT * FROM CRUD where ID = :ID');
$query->bindParam(':ID', $ID);
$query->execute();

$CRUD = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h1>Hello World!</h1>

        <table border="1px">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Categorie</th>
                <th>Benodigdheden</th>
                <th>Voorstuk</th>
                <th>Stappenplan</th>
                <th>Eind tekst</th>
            </tr>


        <?php foreach ($CRUD as $row) {

            ?>

            <tr>
                <td><?= $row['ID']?></td>
                <td><?= $row['Name']?></td>
                <td><?= $row['Categorie']?></td>
                <td><?= $row['Benodigheden']?></td>
                <td><?= $row['Voorstuk']?></td>
                <td><?= $row['StappenPlan']?></td>
                <td><?= $row['EindTekst']?></td>
            </tr>

            <?php } ?>
        </table>
</body>
</html>