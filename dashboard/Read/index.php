<?php
require_once __DIR__ . '/../../database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$query = $db->prepare('SELECT * FROM CRUD WHERE ID = :id');
$query->execute(['id' => $id]);
$recipe = $query->fetch();
if (!$recipe) {
    exit('Recept niet gevonden.');
}
?>
<!doctype html>
<html lang="nl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= htmlspecialchars($recipe['Name']) ?></title><link rel="stylesheet" href="../dashboard.css"></head>
<body>
<main class="dashboard-shell"><div class="panel recipe-view">
    <h1><?= htmlspecialchars($recipe['Name']) ?></h1>
    <p><strong>Categorie:</strong> <?= htmlspecialchars($recipe['Categorie']) ?></p>
    <h2>Introductie</h2><p><?= nl2br(htmlspecialchars($recipe['Voorstuk'])) ?></p>
    <h2>Benodigdheden</h2><p><?= nl2br(htmlspecialchars($recipe['Benodigheden'])) ?></p>
    <h2>Stappenplan</h2><p><?= nl2br(htmlspecialchars($recipe['StappenPlan'])) ?></p>
    <h2>Eindtekst</h2><p><?= nl2br(htmlspecialchars($recipe['EindTekst'])) ?></p>
    <p><a href="../index.php">← Terug naar dashboard</a></p>
</div></main>
</body>
</html>
