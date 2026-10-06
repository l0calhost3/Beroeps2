<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}

$naam = $_POST["naam"];
$categorie = $_POST["Categories"];
$benodigdheden = $_POST["benodigheden"];
$voorstuk = $_POST["voorstuk"];
$stappenplanning = $_POST["StappenPlan"];
$eindtekst = $_POST["eindTekst"];
$ID = $_POST["ID"];

if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'request methode is niet goedgekeurd';
}
if (empty($naam) || empty($categorie) || empty($benodigdheden) || empty($voorstuk) || empty($eindtekst)) {
    echo 'iets is leeg';
}


$sql = "UPDATE CRUD SET Name = :naam, Categorie = :categorie, Benodigheden = :benodigdheden, Voorstuk = :voorstuk, StappenPlan = :stappenplanning, EindTekst = :eindtekst WHERE ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':categorie', $categorie);
$stmt->bindParam(':benodigdheden', $benodigdheden);
$stmt->bindParam(':voorstuk', $voorstuk);
$stmt->bindParam(':stappenplanning', $stappenplanning);
$stmt->bindParam(':eindtekst', $eindtekst);
$stmt->bindParam(':id', $ID);

$stmt->execute();
header("location: ../index.php");