<?php
require_once __DIR__ . '/../../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    $image = saveUploadedRecipeImage($_FILES['image'] ?? []);
} catch (RuntimeException $exception) {
    exit('Afbeelding: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8'));
}

$query = $db->prepare(
    'INSERT INTO CRUD (Name, Categorie, Image, Voorstuk, Benodigheden, StappenPlan, EindTekst)
     VALUES (:name, :category, :image, :intro, :ingredients, :steps, :ending)'
);
$query->execute([
    'name' => trim($_POST['name'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'image' => $image,
    'intro' => trim($_POST['intro'] ?? ''),
    'ingredients' => trim($_POST['ingredients'] ?? ''),
    'steps' => trim($_POST['steps'] ?? ''),
    'ending' => trim($_POST['ending'] ?? ''),
]);

header('Location: ../index.php');
exit;
