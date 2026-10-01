<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/frontend.css">
    <title>Cook masters</title>
</head>
<body>
<header>
    <div class="logo">
        <img src="images/hat.png" alt="#">
        <h1>Cook masters</h1>
    </div>
    <div class="menu">
        <a href="index.php">Home</a>
        <a href="recepten.php">Recepten</a>
        <a href="over_ons.php">Over ons</a>
    </div>
    <div class="register">
        <a class="sign-in" href="">sign in</a>
        <a class="sign-up" href="">sign up</a>
    </div>
</header>
<section>
    <div class="container">
        <div class="intro">
            <div class="info">
                <h2>Lorem ipsum</h2>
                <h3>Lerom pisum</h3>
                <p>Lorem Ipsum is simply dummy text of <br>
                    the printing and typesetting industry. <br>
                    Lorem Ipsum has been the industry's standard
                    <br>dummy text ever since 1966,</p>
                <a href="recepten.php">Bekijk recepten -></a>
            </div>
            <div class="image">
                <img src="images/image.png" alt="#">
            </div>
        </div>
    </div>
</section>
<section class="background">
    <div class="container lines">
        <div class="items">
            <img class="holder" src="images/image2.png" alt="#">
            <div class="about">
                <h2>Who we are?</h2>
                <p>Lorem Ipsum is simply dummy text of the printing
                    and typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since 1966, when designers at Letraset
                    and James Mosley, the librarian at St Bride Printing Library in
                    London, took a 1914 Cicero translation and scrambled it to make dummy
                    text for Letraset's Body Type sheets. It has survived not only many
                    decades, but also the leap into electronic typesetting, remaining
                    essentially unchanged. It was popularised thanks to these sheets and
                    more recently with desktop publishing software like Aldus PageMaker
                    and Microsoft Word including versions of Lorem Ipsum.</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container lines">
        <div class="about">
            <h2>Our example</h2>
        </div>
        <div class="example-items">

            <div class="example-item recipe-card">
                <div class="block-image">
                    <img src="https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&w=1200&q=80"
                         alt="#">
                </div>

                <div class="example-text light">
                    <h2>Croissant</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since 1966</p>
                </div>
            </div>

            <div class="example-item recipe-card">
                <div class="example-text light">
                    <h2>Ebi Tempura</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                        has been the industry's standard dummy text ever since 1966</p>
                </div>

                <div class="block-image">
                    <img src="https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&w=1200&q=80"
                         alt="#">
                </div>
            </div>

        </div>
    </div>
</section>
<footer>
    <div class="end">
        <p>© 2026 TEAM 9 Company. All rights reserved.</p>

        <a href="#" class="scroll-top">
            <img src="images/scroll.png" alt="Scroll to top">
        </a>
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