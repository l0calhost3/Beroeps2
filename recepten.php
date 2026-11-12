<?php
require_once __DIR__ . '/database.php';

$recipes = $db->query('SELECT * FROM CRUD ORDER BY ID DESC')->fetchAll();

$escape = static fn ($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$category = static fn ($value): string => strtolower(trim((string) $value));
$recipeImage = static function (array $recipe): string {
    $image = trim((string) ($recipe['Image'] ?? ''));
    if ($image !== '' && !preg_match('#^(https?:)?//#i', $image) && $image[0] !== '/') {
        $image = str_starts_with($image, 'images/') ? $image : 'images/' . ltrim($image, '/');
    }

    return $image ?: 'images/food.png';
};
$recipeCard = static function (array $recipe, string $class, string $textClass = 'light', string $extraClass = '', bool $hidden = false) use ($escape, $category, $recipeImage): string {
    $image = $recipeImage($recipe);
    $cardClass = trim($class . ' ' . $extraClass);

    return '<a class="' . $escape($cardClass) . ' recipe-card"' . ($hidden ? ' hidden' : '')
        . ' data-category="' . $escape($category($recipe['Categorie'])) . '"'
        . ' data-recipe-id="' . (int) $recipe['ID'] . '"'
        . ' href="recept.php?id=' . (int) $recipe['ID'] . '">'
        . '<img src="' . $escape($image) . '" alt="' . $escape($recipe['Name']) . '">'
        . '<div class="' . ($class === 'block-item' ? 'text ' : 'recipe-text ') . $escape($textClass) . '">'
        . '<h2>' . $escape($recipe['Name']) . '</h2>'
        . '<p>' . $escape($recipe['Voorstuk']) . '</p>'
        . '</div></a>';
};
session_start();

$topRecipes = array_slice($recipes, 0, 3);
$moreTopRecipes = array_slice($recipes, 9);
$middleRecipes = array_slice($recipes, 3, 3);
$wideRecipes = array_slice($recipes, 6, 3);


?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook masters-RECEPTEN</title>
    <link rel="stylesheet" href="css/frontend.css">
</head>
<body id="top">
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
    <?php if (empty($_SESSION['user'])){?>
        <div class="register">
            <a class="sign-in" href="login/index.php?a=in">sign in</a>
            <a class="sign-up" href="login/index.php?a=up">sign up</a>
        </div>
    <?php } else{?>
        <div class="register">
            <a class="sign-in" href="./logout.php">logout</a>
        </div>
    <?php } ?>
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
                <?php if (!empty($_SESSION['user'])){ ?>
                    <a class="recipe-create-button recipe-edit-button" href="dashboard/index.php">Edit recepten</a>
                    <a class="recipe-create-button" href="dashboard/Create/index.php">+ Nieuw recept</a>
                <?php } ?>
            </div>
        </div>
        <div class="block-items recepten-grid" id="recepten-lijst">
            <?php foreach ($topRecipes as $recipe): ?>
                <?= $recipeCard($recipe, 'block-item', 'light') ?>
            <?php endforeach; ?>
            <?php if ($moreTopRecipes): ?>
                <div class="more-recipes-content more-top-recipes" id="more-recepten" hidden>
                    <?php foreach ($moreTopRecipes as $recipe): ?>
                        <?= $recipeCard($recipe, 'block-item', 'light') ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <p class="recipe-no-results" <?= $recipes ? 'hidden' : '' ?>>Geen recepten gevonden. Probeer een andere zoekterm of categorie.</p>
        </div>
        <?php if ($moreTopRecipes): ?>
            <button class="recipe-more-button" type="button" aria-expanded="false" aria-controls="more-recepten">More</button>
        <?php endif; ?>
    </div>
</section>

<section class="background">
    <div class="container lines">
        <div class="second-block-items">
            <?php foreach ($middleRecipes as $index => $recipe): ?>
                <?= $recipeCard($recipe, 'second-block-item', $index === 0 ? 'light' : 'dark') ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section>
    <div class="container lines">
        <div class="third-block-items">
            <?php foreach ($wideRecipes as $index => $recipe): ?>
                <a class="third-block-item <?= $index % 2 === 0 ? 'image-left' : 'image-right' ?> recipe-card"
                    data-category="<?= $escape($category($recipe['Categorie'])) ?>"
                    data-recipe-id="<?= (int) $recipe['ID'] ?>"
                    href="recept.php?id=<?= (int) $recipe['ID'] ?>">
                    <?php if ($index % 2 === 0): ?><div class="block-image"><img src="<?= $escape($recipeImage($recipe)) ?>" alt="<?= $escape($recipe['Name']) ?>"></div><?php endif; ?>
                    <div class="recipe-text light">
                        <h2><?= $escape($recipe['Name']) ?></h2>
                        <p><?= $escape($recipe['Voorstuk']) ?></p>
                    </div>
                    <?php if ($index % 2 !== 0): ?><div class="block-image"><img src="<?= $escape($recipeImage($recipe)) ?>" alt="<?= $escape($recipe['Name']) ?>"></div><?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<footer>
    <div class="end">
        <p>© 2026 TEAM 9 Company. All rights reserved.</p>
        <a href="#top" class="scroll-top"><img src="images/scroll.png" alt="Scroll to top"></a>
    </div>
</footer>
<a class="back-to-top" href="#top" aria-label="Terug naar boven">↑</a>
<script src="js/frontend.js"></script>
</body>
</html>
