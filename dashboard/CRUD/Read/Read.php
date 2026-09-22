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

        <?php foreach ($CRUD as $row) {

            ?>

            <?php } ?>

        <?php var_dump($CRUD) ?>
</body>
</html>