<?php
require_once __DIR__ . '/../../database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$query = $db->prepare('SELECT Name FROM CRUD WHERE ID = :id');
$query->execute(['id' => $id]);
$recipe = $query->fetch();
if (!$recipe) {
    exit('Recept niet gevonden.');
}
?>
<!doctype html>
<html lang="nl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Recept verwijderen</title><link rel="stylesheet" href="../dashboard.css"></head>
<body>
<main class="dashboard-shell"><div class="panel">
    <h1>Recept verwijderen</h1>
    <p>Weet je zeker dat je <strong><?= htmlspecialchars($recipe['Name']) ?></strong> wilt verwijderen?</p>
    <form method="post" action="Delete.php">
        <input type="hidden" name="id" value="<?= (int) $id ?>">
        <button class="button-danger" type="submit">Ja, verwijderen</button>
        <a class="button button-secondary" href="../index.php">Annuleren</a>
    </form>
</div></main>
</body>
</html>
