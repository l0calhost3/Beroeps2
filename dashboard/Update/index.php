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
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Recept wijzigen</title><link rel="stylesheet" href="../dashboard.css"></head>
<body>
<main class="dashboard-shell"><div class="panel">
    <h1>Recept wijzigen</h1>
    <form class="recipe-form" method="post" action="Update.php">
        <input type="hidden" name="id" value="<?= (int) $recipe['ID'] ?>">
        <label>Naam<br><input name="name" required value="<?= htmlspecialchars($recipe['Name']) ?>"></label><br><br>
        <label>Categorie<br><input name="category" required value="<?= htmlspecialchars($recipe['Categorie']) ?>"></label><br><br>
        <label>Afbeelding URL<br><input name="image" type="url" value="<?= htmlspecialchars($recipe['Image'] ?? '') ?>"></label><br><br>
        <label>Introductie<br><textarea name="intro" required rows="4" cols="60"><?= htmlspecialchars($recipe['Voorstuk']) ?></textarea></label><br><br>
        <label>Benodigdheden (één per regel)<br><textarea name="ingredients" required rows="8" cols="60"><?= htmlspecialchars($recipe['Benodigheden']) ?></textarea></label><br><br>
        <label>Stappenplan (één stap per regel)<br><textarea name="steps" required rows="8" cols="60"><?= htmlspecialchars($recipe['StappenPlan']) ?></textarea></label><br><br>
        <label>Eindtekst / tip<br><textarea name="ending" required rows="4" cols="60"><?= htmlspecialchars($recipe['EindTekst']) ?></textarea></label><br><br>
        <div class="form-actions"><button type="submit">Wijzigingen opslaan</button><a class="button button-secondary" href="../index.php">Annuleren</a></div>
    </form>
    </div></main>
</body>
</html>
