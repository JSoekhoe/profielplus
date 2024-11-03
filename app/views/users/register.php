<div class="login-container"> <!-- Container voor het registratieformulier, met een klasse voor styling -->
    <h2>Registreren</h2> <!-- Hoofdtitel voor de registratiepagina -->

    <form action="/register" method="POST"> <!-- Begin van het registratieformulier, verzendt een POST-verzoek naar de /register URL -->
        <label for="username">Gebruikersnaam:</label> <!-- Label voor het invoerveld van de gebruikersnaam -->
        <input type="text" id="username" name="username" required> <!-- Invoerveld voor de gebruikersnaam, verplicht veld -->

        <label for="email">E-mail:</label> <!-- Label voor het invoerveld van het e-mailadres -->
        <input type="email" id="email" name="email" required> <!-- Invoerveld voor e-mail, verplicht veld -->

        <label for="password">Wachtwoord:</label> <!-- Label voor het invoerveld van het wachtwoord -->
        <input type="password" id="password" name="password" required> <!-- Invoerveld voor het wachtwoord, verplicht veld -->

        <label for="confirm_password">Bevestig Wachtwoord:</label> <!-- Label voor het invoerveld van het bevestigen van het wachtwoord -->
        <input type="password" id="confirm_password" name="confirm_password" required> <!-- Invoerveld voor het bevestigen van het wachtwoord, verplicht veld -->

        <button type="submit">Registreren</button> <!-- Verzendenknop voor het registratieformulier -->
    </form>

    <a href="/login" class="cancel-button">Annuleer</a> <!-- Link om terug te gaan naar de inlogpagina -->
</div>

<?php if (!empty($errors)): ?> <!-- Controleert of er fouten zijn om weer te geven -->
    <div class="errors"> <!-- Container voor foutmeldingen -->
        <?php foreach ($errors as $error): ?> <!-- Loopt door de fouten heen -->
            <p><?php echo htmlspecialchars($error); ?></p> <!-- Weergeven van elke foutmelding, met HTML-entities om XSS te voorkomen -->
        <?php endforeach; ?> <!-- Einde van de foreach-loop -->
    </div> <!-- Einde van de foutmeldingen container -->
<?php endif; ?> <!-- Einde van de if-controle voor fouten -->
