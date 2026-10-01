<?php
try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}
$sql = "SELECT DISTINCT categorie FROM CRUD ORDER BY categorie ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
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
<form action="./Create.php" method="POST">
    <h1>vul hier je recept in</h1>
    <input type="text" name="naam" id="naam" placeholder="naam recept">
    <br><br>
    <input type="text" name="Categories" id="Categories_input" list="Categories" placeholder="wat voor categorie valt hij?">
    <br><br>
    <textarea name="benodigheden" id="benodigheden" cols="30" rows="10" placeholder="benodigheden"></textarea>
    <br><br>
    <textarea name="voorstuk" id="voorstuk" cols="30" rows="10" placeholder="voorstuk"></textarea>
    <br><br>
    <textarea name="StappenPlan" id="StappenPlan" cols="30" rows="10" placeholder="StappenPlan"></textarea>
    <br><br>
    <textarea name="eindTekst" id="eindTekst" cols="30" rows="10" placeholder="eindTekst"></textarea>
    <br><br>
    <input type="submit" value="submit hier" placeholder="submit hier">
</form>



<datalist id="Categories">
    <?php while ($categorie = $stmt->fetch(PDO::FETCH_ASSOC)):?>) { ?>
            <option value="<?php echo $categorie?>"><?php $categorie ?></option>
    <?php endwhile; ?>} ?>
</datalist>
</body>
</html>
