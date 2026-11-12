<?php
session_start();
require_once __DIR__ . '/../../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$currentQuery = $db->prepare('SELECT Image FROM CRUD WHERE ID = :id');
$currentQuery->execute(['id' => $id]);
$currentImage = $currentQuery->fetchColumn();
try {
    $uploadedImage = saveUploadedRecipeImage($_FILES['image'] ?? []);
} catch (RuntimeException $exception) {
    exit('Afbeelding: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8'));
}

$query = $db->prepare(
    'UPDATE CRUD SET Name = :name, Categorie = :category, Image = :image,
     Voorstuk = :intro, Benodigheden = :ingredients, StappenPlan = :steps
     WHERE ID = :id'
);
$query->execute([
    'id' => $id,
    'name' => trim($_POST['name'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'image' => $uploadedImage ?: $currentImage,
    'intro' => trim($_POST['intro'] ?? ''),
    'ingredients' => trim($_POST['ingredients'] ?? ''),
    'steps' => trim($_POST['steps'] ?? ''),
]);

header('Location: ../index.php');
exit;
