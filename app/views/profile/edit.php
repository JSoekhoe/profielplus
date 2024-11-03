<div class="edit-form-container"> <!-- Container voor het bewerkformulier met een klasse voor styling -->
    <h1>Bewerk je Profiel</h1> <!-- Hoofdtitel voor het formulier -->

    <form action="/profile/edit" method="POST"> <!-- Begin van het formulier dat verzonden wordt naar /profile/edit met de POST-methode -->

        <label for="firstname">Voornaam:</label> <!-- Label voor het invoerveld van de voornaam -->
        <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($user->firstname); ?>" required> <!-- Invoerveld voor de voornaam, met vooraf ingevulde waarde uit de gebruiker en verplicht -->

        <label for="lastname">Achternaam:</label> <!-- Label voor het invoerveld van de achternaam -->
        <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user->lastname); ?>" required> <!-- Invoerveld voor de achternaam, met vooraf ingevulde waarde uit de gebruiker en verplicht -->

        <label for="username">Gebruikersnaam:</label> <!-- Label voor het invoerveld van de gebruikersnaam -->
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user->username); ?>" required> <!-- Invoerveld voor de gebruikersnaam, met vooraf ingevulde waarde uit de gebruiker en verplicht -->

        <label for="email">E-mail:</label> <!-- Label voor het invoerveld van het e-mailadres -->
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email); ?>" required> <!-- Invoerveld voor het e-mailadres, met vooraf ingevulde waarde uit de gebruiker en verplicht -->

        <label for="bio">Bio:</label> <!-- Label voor het invoerveld van de bio -->
        <input type="text" name="bio" id="bio" value="<?php echo htmlspecialchars($profile->bio ?? ''); ?>" required> <!-- Invoerveld voor de bio, met vooraf ingevulde waarde uit het profiel en verplicht -->

        <label for="phone">Telefoon:</label> <!-- Label voor het invoerveld van het telefoonnummer -->
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($profile->phone ?? ''); ?>"> <!-- Invoerveld voor het telefoonnummer, met vooraf ingevulde waarde uit het profiel -->

        <button type="submit">Profiel Bijwerken</button> <!-- Knop om het formulier in te dienen en het profiel bij te werken -->
        <a href="/dashboard" class="cancel-button">Annuleer</a> <!-- Link om te annuleren en terug te gaan naar het dashboard -->
    </form>
</div> <!-- Einde van de container voor het bewerkformulier -->
