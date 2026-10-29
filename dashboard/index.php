<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$db = new PDO('sqlite:CRUD-DB.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $db->QUERY('SELECT * FROM CRUD');
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
<a href="./Create">create</a>
<table border="1px">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Categorie</th>
        <th>Benodigdheden</th>
        <th>Voorstuk</th>
        <th>Stappenplan</th>
        <th>Eind tekst</th>
        <th>more</th>
        <th>update</th>
        <th>Delete</th>
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
            <td><a href="./Read/index.php?ID=<?= $row['ID']?>">Read</a></td>
            <td><a href="./Update/index.php?ID=<?= $row['ID']?>">Update</a></td>
            <td><a class="confirmation" href="./Delete/Delete.php?ID=<?= $row['ID']?>">Delete</a></td>
        </tr>

    <?php } ?>
</table>
<script type="text/javascript">
    let elems = document.getElementsByClassName('confirmation');
    let confirmIt = function (e) {
        if (!confirm('Are you sure you want to continue?')) {
            e.preventDefault(); // Stops the link or action if user clicks Cancel
        }
    };
    for (let i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
</body>
</html>