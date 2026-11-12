<?php
require_once __DIR__ . '/../database.php';

$recipes = $db->query('SELECT * FROM CRUD ORDER BY ID DESC')->fetchAll();
?>
<!doctype html>
<html lang="nl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Recepten beheren</title><link rel="stylesheet" href="dashboard.css"></head>
<body>
<main class="dashboard-shell">
    <header class="dashboard-header"><div><h1>Recepten beheren</h1><p class="muted">Maak, wijzig en verwijder recepten voor Cook masters.</p></div><a class="button" href="Create/index.php">+ Nieuw recept</a></header>
    <div class="panel">
    <?php if (!$recipes): ?><p class="notice">Er zijn nog geen recepten. Voeg je eerste recept toe.</p><?php endif; ?>
    <table class="recipe-table">
        <tr><th>ID</th><th>Naam</th><th>Categorie</th><th>Acties</th></tr>
        <?php foreach ($recipes as $recipe): ?>
            <tr>
                <td><?= (int) $recipe['ID'] ?></td>
                <td><?= htmlspecialchars($recipe['Name']) ?></td>
                <td><?= htmlspecialchars($recipe['Categorie']) ?></td>
                <td class="actions">
                    <a class="button button-small button-secondary" href="Read/index.php?id=<?= (int) $recipe['ID'] ?>">Bekijken</a>
                    <a class="button button-small" href="Update/index.php?id=<?= (int) $recipe['ID'] ?>">Wijzigen</a>
                    <a class="button button-small button-danger" href="Delete/index.php?id=<?= (int) $recipe['ID'] ?>">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="../recepten.php">← Naar de website</a></p>
    </div>
</main>
</body>
</html>
