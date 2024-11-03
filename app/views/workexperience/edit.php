<div class="edit-form-container"> <!-- Container voor het formulier om werkervaring te bewerken, met een klasse voor styling -->
    <h1>Werkervaring Bewerken</h1> <!-- Hoofdtitel voor de pagina, geeft aan dat de gebruiker werkervaring kan bewerken -->

    <form action="/workexperience/edit/<?= htmlspecialchars($workExperience->id) ?>" method="POST"> <!-- Begin van het formulier; verzendt een POST-verzoek naar de bewerk-URL met de ID van de werkervaring -->
        <label for="company">Bedrijf:</label> <!-- Label voor het invoerveld van het bedrijf -->
        <input type="text" name="company" id="company" value="<?= htmlspecialchars($workExperience->company) ?>" required> <!-- Invoerveld voor het bedrijf, dat vooraf is ingevuld met de huidige waarde, verplicht veld -->

        <label for="job_title">Functie:</label> <!-- Label voor het invoerveld van de functietitel -->
        <input type="text" name="job_title" id="job_title" value="<?= htmlspecialchars($workExperience->job_title) ?>" required> <!-- Invoerveld voor de functietitel, vooraf ingevuld en verplicht -->

        <label for="start_date">Startdatum:</label> <!-- Label voor het invoerveld van de startdatum -->
        <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($workExperience->start_date) ?>" required> <!-- Invoerveld voor de startdatum, vooraf ingevuld en verplicht, met type date voor een datumkiezer -->

        <label for="end_date">Einddatum:</label> <!-- Label voor het invoerveld van de einddatum -->
        <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($workExperience->end_date) ?>"> <!-- Invoerveld voor de einddatum, vooraf ingevuld, niet verplicht -->

        <label for="description">Beschrijving:</label> <!-- Label voor het invoerveld van de beschrijving -->
        <textarea name="description" id="description" rows="4"><?= htmlspecialchars($workExperience->description) ?></textarea> <!-- Tekstgebied voor de beschrijving, vooraf ingevuld, met 4 rijen -->

        <button type="submit">Opslaan</button> <!-- Verzendenknop voor het formulier, om de wijzigingen op te slaan -->
        <a href="/dashboard" class="cancel-button">Annuleer</a> <!-- Link om de bewerking te annuleren en terug te keren naar het dashboard -->
    </form>
</div>
