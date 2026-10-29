<?php
$naam = $_POST["naam"];
$categorie = $_POST["Categories"];
$benodigdheden = $_POST["benodigheden"];
$voorstuk = $_POST["voorstuk"];
$stappenplanning = $_POST["StappenPlan"];
$eindtekst = $_POST["eindTekst"];
$error = array();


 if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    array_push($error, 'server methode is niet goedgekeurt');
 }
 if (empty($naam) || empty($categorie) || empty($benodigdheden) || empty($voorstuk) || empty($eindtekst)) {
     array_push($error, 'er is iets leeg');
 }



if (empty($error)) {


try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}

 $sql = 'INSERT INTO CRUD (Name, Categorie, Benodigheden, Voorstuk, StappenPlan, Eindtekst) 
values (:naam, :categorie, :benodigdheden, :voorstuk, :stappenplan, :eindtekst)';
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
}
else{
    foreach ($error as $errors) {
        echo $errors;
    }
    echo '<br><a href="./">Terug naar home</a>';
}