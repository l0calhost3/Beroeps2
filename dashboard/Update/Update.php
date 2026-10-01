<?php
$naam = $_POST["naam"];
$categorie = $_POST["Categories"];
$benodigdheden = $_POST["benodigheden"];
$voorstuk = $_POST["voorstuk"];
$stappenplanning = $_POST["StappenPlan"];
$eindtekst = $_POST["eindTekst"];
if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'request methode is niet goedgekeurd';
}
if (empty($naam) || empty($categorie) || empty($benodigdheden) || empty($voorstuk) || empty($eindtekst)) {
    echo 'iets is leeg';
}
try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}

$sql = "UPDATE CRUD
SET Naam = :naam, Categorie = :categorie, Benodigheden = :benodigdheden, Voorstuk = :voorstuk, StappenPlan = :stappenplanning, EindTekst = :eindtekst WHERE id = :id";"
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':naam' => $naam,
    ':categorie' => $categorie,
    ':benodigdheden' => $benodigdheden,
    ':voorstuk' => $voorstuk,
    ':stappenplan' => $stappenplanning,
    ':eindtekst' => $eindtekst
]);
header("location: ../index.php");