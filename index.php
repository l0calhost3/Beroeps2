<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook masters</title>
    <link rel="stylesheet" href="css/frontend.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="images/hat.png" alt="Cook masters logo">
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
        <div class="intro">
            <div class="info">
                <h2>Vers koken</h2>
                <h3>met plezier</h3>
                <p>Ontdek lekkere recepten, duidelijke stappen<br>
                    en inspiratie voor elke dag.<br>
                    Van een snel ontbijt tot een uitgebreid diner.</p>
                <a href="recepten.php">Bekijk recepten →</a>
            </div>
            <div class="scroll">
                <button id="button-prev" class="arrow left" aria-label="Vorige foto"></button>
                <img id="image" src="images/image.png" alt="Gerecht van Cook masters">
                <button id="button-next" class="arrow right" aria-label="Volgende foto"></button>
            </div>
        </div>
    </div>
</section>
<section class="background">
    <div class="container lines">
        <div class="items">
            <img class="holder" src="images/image2.png" alt="Samen koken">
            <div class="about">
                <h2>Wie zijn wij?</h2>
                <p>Cook masters is een plek voor iedereen die graag kookt. We verzamelen
                    recepten die duidelijk zijn uitgelegd en makkelijk thuis te maken zijn.
                    Zo krijg je inspiratie, leer je nieuwe technieken en staat er altijd iets
                    lekkers op tafel.</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container lines">
        <div class="about">
            <h2>Onze favorieten</h2>
        </div>
        <div class="example-items">
            <div class="example-item recipe-card">
                <div class="block-image">
                    <img src="https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&w=1200&q=80"
                         alt="Macarons">
                </div>
                <div class="example-text light">
                    <h2>Macarons</h2>
                    <p>Kleine Franse koekjes met een knapperig randje en een zachte vulling.</p>
                </div>
            </div>
            <div class="example-item recipe-card">
                <div class="example-text light">
                    <h2>Ebi Tempura</h2>
                    <p>Krokante garnalen in een luchtig beslag met een frisse dipsaus.</p>
                </div>
                <div class="block-image">
                    <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=1200&q=80"
                         alt="Ebi tempura">
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="end">
        <p>© 2026 TEAM 9 Company. All rights reserved.</p>
        <a href="#" class="scroll-top"><img src="images/scroll.png" alt="Scroll naar boven"></a>
    </div>
</footer>
<div class="recipe-modal" id="recipe-modal" hidden>
    <div class="recipe-modal-content" role="dialog" aria-modal="true" aria-labelledby="recipe-modal-title">
        <button class="recipe-modal-close" type="button" aria-label="Sluiten">&times;</button>
        <img class="recipe-modal-image" src="" alt="">
        <div class="recipe-modal-text">
            <h2 id="recipe-modal-title"></h2>
            <p></p>
        </div>
    </div>
</div>
<script src="js/frontend.js"></script>
</body>
</html>
