<!doctype html>
<html lang="nl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Recept toevoegen</title><link rel="stylesheet" href="../dashboard.css"></head>
<body>
<main class="dashboard-shell"><div class="panel">
    <h1>Recept toevoegen</h1>
    <p class="muted">Vul elk onderdeel in. Ingrediënten en stappen schrijf je één per regel.</p>
    <form class="recipe-form" method="post" action="Create.php">
        <label>Naam<br><input name="name" required></label><br><br>
        <label>Categorie<br><input name="category" required placeholder="bijv. desserts"></label><br><br>
        <label>Afbeelding URL<br><input name="image" type="url" placeholder="https://..."></label><br><br>
        <label>Introductie<br><textarea name="intro" required rows="4" cols="60"></textarea></label><br><br>
        <label>Benodigdheden (één per regel)<br><textarea name="ingredients" required rows="8" cols="60"></textarea></label><br><br>
        <label>Stappenplan (één stap per regel)<br><textarea name="steps" required rows="8" cols="60"></textarea></label><br><br>
        <label>Eindtekst / tip<br><textarea name="ending" required rows="4" cols="60"></textarea></label><br><br>
        <div class="form-actions"><button type="submit">Recept opslaan</button><a class="button button-secondary" href="../index.php">Annuleren</a></div>
    </form>
    </div></main>
</body>
</html>
