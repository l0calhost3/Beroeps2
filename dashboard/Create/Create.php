<?php
$naam = $_POST["naam"];
$categorie = $_POST["Categories"];
$benodigdheden = $_POST["benodigheden"];
$voorstuk = $_POST["voorstuk"];
$stappenplanning = $_POST["StappenPlan"];
$eindtekst = $_POST["eindTekst"];
$error = array();

$file = $_FILES['file'];

$uploadDir = "../img/";

     if (!$_SERVER["REQUEST_METHOD"] == "POST") {
        array_push($error, 'server methode is niet goedgekeurt');
     }
     if (empty($naam) || empty($categorie) || empty($benodigdheden) || empty($voorstuk) || empty($eindtekst)) {
         array_push($error, 'er is iets leeg');
     }
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        array_push($error,"Please upload an image.");
    }
    $imageInfo = getimagesize($_FILES['file']['tmp_name']);
    if ($imageInfo === false) {
        array_push($error,"Only image files are allowed.");
    }
// Allowed MIME types
$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/gif'  => 'gif',
    'image/webp' => 'webp'
];

$mimeType = mime_content_type($_FILES['file']['tmp_name']);

if (!isset($allowedTypes[$mimeType])) {
    die("Invalid image type.");
}

// Create unique filename
$extension = $allowedTypes[$mimeType];
$fileName = uniqid('img_', true) . '.' . $extension;

$destination = $uploadDir . $fileName;

if (!move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
    die("Failed to save image.");
}


if (empty($error)) {


try {
//connectie database
    $pdo = new PDO("sqlite:../CRUD-DB.sqlite");
}catch(PDOException $e){
    echo $e->getMessage();
}

 $sql = 'INSERT INTO CRUD (Name, Categorie, Benodigheden, Voorstuk, StappenPlan, Eindtekst, IMG) 
values (:naam, :categorie, :benodigdheden, :voorstuk, :stappenplan, :eindtekst, :image)';
 $stmt = $pdo->prepare($sql);
 $stmt->execute([
     ':naam' => $naam,
     ':categorie' => $categorie,
     ':benodigdheden' => $benodigdheden,
     ':voorstuk' => $voorstuk,
     ':stappenplan' => $stappenplanning,
     ':eindtekst' => $eindtekst,
     ':image' => $fileName
 ]);
 header("location: ../index.php");
}
else{
    foreach ($error as $errors) {
        echo $errors;
    }
    echo '<br><a href="./">Terug naar de from</a>';
}