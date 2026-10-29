<?php
require_once __DIR__ . '/database.php';

$recipes = $db->query('SELECT * FROM CRUD ORDER BY ID DESC')->fetchAll();

$escape = static fn ($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$category = static fn ($value): string => strtolower(trim((string) $value));
$recipeCard = static function (array $recipe, string $class, string $textClass = 'light') use ($escape, $category): string {
    $image = $recipe['Image'] ?: 'images/food.png';

    return '<a class="' . $escape($class) . ' recipe-card"'
        . ' data-category="' . $escape($category($recipe['Categorie'])) . '"'
        . ' data-recipe-id="' . (int) $recipe['ID'] . '"'
        . ' href="recept.php?id=' . (int) $recipe['ID'] . '">'
        . '<img src="' . $escape($image) . '" alt="' . $escape($recipe['Name']) . '">'
        . '<div class="' . ($class === 'block-item' ? 'text ' : 'recipe-text ') . $escape($textClass) . '">'
        . '<h2>' . $escape($recipe['Name']) . '</h2>'
        . '<p>' . $escape($recipe['Voorstuk']) . '</p>'
        . '</div></a>';
};

$cardAt = static function (int $index) use ($recipes): ?array {
    if (!$recipes) {
        return null;
    }

    return $recipes[$index % count($recipes)];
};
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook masters-RECEPTEN</title>
    <link rel="stylesheet" href="css/frontend.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="images/hat.png" alt="">
        <h1>Cook masters</h1>
    </div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="recepten.php">Recepten</a>
        <a href="over_ons.php">Over ons</a>
    </div>
    <div class="register">
        <a class="sign-in" href="login/index.php">sign in</a>
        <a class="sign-up" href="login/index.php">sign up</a>
    </div>
</header>

<section>
    <div class="container">
        <div class="about">
            <h2>Recepten</h2>
        </div>
        <div class="recipe-filters" aria-label="Recepten filteren">
            <div class="recipe-categories" role="group" aria-label="Filter op categorie">
                <button class="recipe-filter active" type="button" data-category="all">Alle</button>
                <button class="recipe-filter" type="button" data-category="soepen">Soepen</button>
                <button class="recipe-filter" type="button" data-category="hoofdgerechten">Hoofdgerechten</button>
                <button class="recipe-filter" type="button" data-category="desserts">Desserts</button>
                <button class="recipe-filter" type="button" data-category="ontbijt">Ontbijt</button>
            </div>
            <label class="recipe-search">
                <span>Zoek op naam</span>
                <input id="recipe-search" type="search" placeholder="Bijv. Croissant" autocomplete="off">
            </label>
        </div>
        <div class="recipe-list-heading">
            <span>Onze recepten</span>
            <div class="recipe-list-actions">
                <a class="recipe-create-button recipe-edit-button" href="dashboard/index.php">Edit recepten</a>
                <a class="recipe-create-button" href="dashboard/Create/index.php">+ Nieuw recept</a>
            </div>
        </div>
        <div class="block-items recepten-grid">
            <?php for ($index = 0; $index < 3; $index++): ?>
                <?php $recipe = $cardAt($index); ?>
                <?php if ($recipe): ?>
                    <?= $recipeCard($recipe, 'block-item', 'light') ?>
                <?php endif; ?>
            <?php endfor; ?>
            <p class="recipe-no-results" <?= $recipes ? 'hidden' : '' ?>>Geen recepten gevonden. Probeer een andere zoekterm of categorie.</p>
        </div>
    </div>
</section>

<section class="background">
    <div class="container lines">
        <div class="second-block-items">
            <?php for ($index = 3; $index < 6; $index++): ?>
                <?php $recipe = $cardAt($index); ?>
                <?php if ($recipe): ?>
                    <?= $recipeCard($recipe, 'second-block-item', $index === 3 ? 'light' : 'dark') ?>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<section>
    <div class="container lines">
        <div class="third-block-items">
            <?php for ($index = 0; $index < 3; $index++): ?>
                <?php $recipe = $cardAt($index + 1); ?>
                <?php if ($recipe): ?>
                    <div class="third-block-item <?= $index % 2 === 0 ? 'image-left' : 'image-right' ?> recipe-card"
                         data-category="<?= $escape($category($recipe['Categorie'])) ?>"
                         data-recipe-id="<?= (int) $recipe['ID'] ?>"
                         tabindex="0">
                        <?php if ($index % 2 === 0): ?><div class="block-image"><img src="<?= $escape($recipe['Image'] ?: 'images/food.png') ?>" alt="<?= $escape($recipe['Name']) ?>"></div><?php endif; ?>
                        <div class="recipe-text light">
                            <h2><?= $escape($recipe['Name']) ?></h2>
                            <p><?= $escape($recipe['Voorstuk']) ?></p>
                        </div>
                        <?php if ($index % 2 !== 0): ?><div class="block-image"><img src="<?= $escape($recipe['Image'] ?: 'images/food.png') ?>" alt="<?= $escape($recipe['Name']) ?>"></div><?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<footer>
    <div class="end">
        <p>© 2026 TEAM 9 Company. All rights reserved.</p>
        <a href="#" class="scroll-top"><img src="images/scroll.png" alt="Scroll to top"></a>
    </div>
</footer>
<script src="js/frontend.js"></script>
</body>
</html>
