// Functie om login formulier te valideren
function validateLogin() {
    // Haal waarden op uit het formulier
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage = document.getElementById('errorMessage');

    // Reset foutmelding
    errorMessage.style.display = 'none';

    // Validatie logica
    if (username === "" || password === "") {
        // Toon foutmelding als velden leeg zijn
        showError("Vul alle velden in.");
        return;
    }

    if (password.length < 6) {
        // Toon foutmelding als wachtwoord te kort is
        showError("Wachtwoord moet minstens 6 tekens lang zijn.");
        return;
    }

    // Simuleer een succesvolle login
    alert("Welkom, " + username + "!");
}

// Functie om foutmeldingen weer te geven
function showError(message) {
    const errorMessage = document.getElementById('errorMessage');
    errorMessage.innerText = message;
    errorMessage.style.display = 'block';
}

// JavaScript-functionaliteit en gebruikersinteracties

/**
 * Toont een welkomstbericht aan de gebruiker.
 */
function showWelcomeMessage() {
    alert("Welkom op de website!");
}

/**
 * Wijzigt de tekstinhoud van een element met een specifieke ID.
 * @param {string} elementId - De ID van het element.
 * @param {string} message - De tekst om in het element weer te geven.
 */
function updateMessage(elementId, message) {
    const element = document.getElementById(elementId);
    if (element) {
        element.innerText = message;
    } else {
        console.warn(`Element met ID '${elementId}' niet gevonden.`);
    }
}

/**
 * Wijzigt de achtergrondkleur van de body bij het klikken op een knop.
 */
function changeBackgroundColor() {
    document.body.style.backgroundColor = "#e0f7fa"; // Lichte blauwachtige kleur
}

// Event listener voor pagina-interacties
document.addEventListener("DOMContentLoaded", function() {
    // Toon een welkombericht zodra de pagina is geladen
    showWelcomeMessage();

    // Voeg een event listener toe aan de login knop
    const loginButton = document.getElementById("loginForm");
    if (loginButton) {
        loginButton.addEventListener("submit", function(event) {
            validateLogin(); // Roep de validatiefunctie aan
        });
    }

    // Voeg klik-event toe aan de knop voor achtergrondkleurwijziging
    const colorButton = document.getElementById("colorButton");
    if (colorButton) {
        colorButton.addEventListener("click", changeBackgroundColor);
    }

    // Update het bericht in een specifieke sectie
    updateMessage("welcome-message", "Bedankt voor je bezoek!");
});
