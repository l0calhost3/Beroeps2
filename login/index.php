
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen | Recepten</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<main class="login-page">

    <a href="../index.php" class="back-link">← Terug naar startpagina</a>

    <div class="auth-container">
        <div class="auth-heading">
            <span class="subtitle">WELKOM TERUG</span>
            <h1>Welkom in onze keuken</h1>
            <p>Log in of maak een account aan om meer recepten te ontdekken.</p>
        </div>
        <div class="auth-forms">
            <div class="auth-card">
                <h2>Inloggen</h2>
                <p class="card-description">Heb je al een account?</p>
                <form action="./login_verwerking.php" method="POST">
                    <label for="login_input">Gebruikersnaam</label>
                    <input type="text" id="login_input"
                           name="login_input" placeholder="Voer je gebruikersnaam in" required>
                    <label for="login_pass">Wachtwoord</label>
                    <input type="password" id="login_pass"
                           name="login_pass" placeholder="Voer je wachtwoord in" required>
                    <input type="hidden" name="SUBMIT" value="login">
                    <button type="submit">Inloggen <span>→</span></button>
                </form>
            </div>
            <div class="auth-card register-card">
                <h2>Account aanmaken</h2>
                <p class="card-description">Nieuw hier? Word lid van onze community.</p>
                <form action="./login_verwerking.php" method="POST">
                    <label for="create_input">Gebruikersnaam</label>
                    <input type="text" id="create_input"
                           name="create_input" placeholder="Kies een gebruikersnaam" required>
                    <label for="create_pass">Wachtwoord</label>
                    <input type="password" id="create_pass"
                           name="create_pass" placeholder="Maak een wachtwoord aan" required>
                    <input type="hidden" name="SUBMIT" value="Create">
                    <button type="submit">Account aanmaken <span>→</span></button>
                </form>
            </div>
        </div>
    </div>
</main>

</body>
</html>
