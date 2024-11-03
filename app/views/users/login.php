<?php
$title = 'Inloggen';  // Dynamische titel voor de pagina, instellen op 'Inloggen'
?>

<div class="login-container"> <!-- Container voor het inlogformulier, met een klasse voor styling -->
    <h2>Inloggen</h2> <!-- Hoofdtitel voor de inlogsectie -->

    <form id="loginForm" method="POST" action="/login"> <!-- Begin van het formulier, verzendt een POST-verzoek naar de /login URL -->
        <div class="input-group"> <!-- Groep voor de gebruikersnaaminvoer -->
            <label for="username">Gebruikersnaam</label> <!-- Label voor het invoerveld van de gebruikersnaam -->
            <input type="text" id="username" name="username_or_email" placeholder="Voer je gebruikersnaam of email in"> <!-- Invoerveld voor gebruikersnaam of email, met een placeholder -->
        </div>

        <div class="input-group"> <!-- Groep voor het wachtwoordveld -->
            <label for="password">Wachtwoord</label> <!-- Label voor het invoerveld van het wachtwoord -->
            <input type="password" id="password" name="password" placeholder="Voer je wachtwoord in"> <!-- Invoerveld voor het wachtwoord, met een placeholder -->
        </div>

        <button type="submit" id="loginButton">Login</button> <!-- Verzendenknop voor het inlogformulier -->

        <p id="errorMessage" class="error-message"></p> <!-- Paragraaf voor het weergeven van foutmeldingen, standaard leeg -->
    </form>
</div> <!-- Einde van de login-container -->
