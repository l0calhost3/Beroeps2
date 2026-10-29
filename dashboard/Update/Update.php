<?php
require_once __DIR__ . '/../../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$query = $db->prepare(
    'UPDATE CRUD SET Name = :name, Categorie = :category, Image = :image,
     Voorstuk = :intro, Benodigheden = :ingredients, StappenPlan = :steps, EindTekst = :ending
     WHERE ID = :id'
);
$query->execute([
    'id' => filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT),
    'name' => trim($_POST['name'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'image' => trim($_POST['image'] ?? ''),
    'intro' => trim($_POST['intro'] ?? ''),
    'ingredients' => trim($_POST['ingredients'] ?? ''),
    'steps' => trim($_POST['steps'] ?? ''),
    'ending' => trim($_POST['ending'] ?? ''),
]);

header('Location: ../index.php');
exit;
