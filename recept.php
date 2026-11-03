<?php
require_once __DIR__ . '/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$recipe = null;

if ($id) {
    $query = $db->prepare('SELECT * FROM CRUD WHERE ID = :id');
    $query->execute(['id' => $id]);
    $recipe = $query->fetch();
}

$ingredients = $recipe ? preg_split('/\R/', trim($recipe['Benodigheden'])) : [];
$steps = $recipe ? preg_split('/\R/', trim($recipe['StappenPlan'])) : [];
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $recipe ? htmlspecialchars($recipe['Name']) : 'Recept niet gevonden' ?> - Cook masters</title>
    <link rel="stylesheet" href="css/frontend.css">
</head>
<body>
<header>
    <div class="logo"><img src="images/hat.png" alt=""><h1>Cook masters</h1></div>
    <div class="menu"><a href="index.php">Home</a><a href="recepten.php">Recepten</a><a href="over_ons.php">Over ons</a></div>
    <div class="register"><a class="sign-in" href="login/index.php">sign in</a><a class="sign-up" href="login/index.php">sign up</a></div>
</header>
<main class="recipe-detail-page">
    <div class="recipe-actions">
        <a class="recipe-action recipe-action-back" href="recepten.php">← Alle recepten</a>
        <?php if ($recipe): ?>
            <button class="recipe-action recipe-action-light" type="button" onclick="window.print()">Print recept</button>
            <a class="recipe-action recipe-action-light" href="dashboard/Update/index.php?id=<?= (int) $recipe['ID'] ?>">✎ Wijzigen</a>
            <a class="recipe-action recipe-action-danger" href="dashboard/Delete/index.php?id=<?= (int) $recipe['ID'] ?>">× Verwijderen</a>
        <?php endif; ?>
    </div>
    <?php if (!$recipe): ?>
        <div class="recipe-not-found"><h2>Recept niet gevonden</h2><p>Dit recept bestaat niet (meer).</p></div>
    <?php else: ?>
        <article class="recipe-detail">
            <div class="recipe-hero">
                <div class="recipe-image-wrap">
                    <img class="recipe-detail-image" src="<?= htmlspecialchars($recipe['Image'] ?: 'images/food.png') ?>" alt="<?= htmlspecialchars($recipe['Name']) ?>">
                    <span class="recipe-image-label">Cook masters</span>
                </div>
                <div class="recipe-detail-content">
                    <p class="recipe-category"><?= htmlspecialchars($recipe['Categorie']) ?></p>
                    <h2><?= htmlspecialchars($recipe['Name']) ?></h2>
                    <p class="recipe-intro"><?= htmlspecialchars($recipe['Voorstuk']) ?></p>
                    <a class="recipe-start" href="#bereiding">Bekijk bereiding <span>↓</span></a>
                </div>
            </div>
            <div class="recipe-columns">
                <section class="recipe-panel ingredients-panel">
                    <div class="recipe-panel-heading"><span class="recipe-panel-icon">✦</span><div><p>Wat heb je nodig?</p><h3>Benodigdheden</h3></div></div>
                    <ul><?php foreach ($ingredients as $ingredient): ?><li><?= htmlspecialchars($ingredient) ?></li><?php endforeach; ?></ul>
                </section>
                <section class="recipe-panel steps-panel" id="bereiding">
                    <div class="recipe-panel-heading"><span class="recipe-panel-icon">01</span><div><p>Stap voor stap</p><h3>Bereiding</h3></div></div>
                    <ol><?php foreach ($steps as $step): ?><li><?= htmlspecialchars($step) ?></li><?php endforeach; ?></ol>
                </section>
            </div>
        </article>
    <?php endif; ?>
</main>
<footer><div class="end"><p>© 2026 TEAM 9 Company. All rights reserved.</p><a href="#" class="scroll-top"><img src="images/scroll.png" alt="Scroll to top"></a></div></footer>
</body>
</html>
