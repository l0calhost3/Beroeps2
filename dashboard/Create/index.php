<?php
try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}
$sql = "SELECT Categorie FROM CRUD";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$Categorie = $stmt->fetch();
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
<form action="./Create.php" method="post">
    <h1>vul hier je recept in</h1>
    <input type="text" name="naam" id="" placeholder="naam recept">
    <br><br>
    <input type="text" name="Categories" id="" list="Categories" placeholder="wat voor categorie valt hij?">
    <br><br>
    <textarea name="benodigheden" id="" cols="30" rows="10" placeholder="benodigheden"></textarea>
    <br><br>
    <textarea name="voorstuk" id="" cols="30" rows="10" placeholder="voorstuk"></textarea>
    <br><br>
    <textarea name="StappenPlan" id="" cols="30" rows="10" placeholder="StappenPlan"></textarea>
    <br><br>
    <textarea name="eindTekst" id="" cols="30" rows="10" placeholder="eindTekst"></textarea>
    <br><br>
    <input type="submit" value="submit hier" placeholder="submit hier">
</form>



<datalist id="Categories">
    <?php foreach ($Categorie as $category) { ?>
        <option value="<?= $category ?>"><?= $category ?></option>
    <?php } ?>
</datalist>
</body>
</html>
