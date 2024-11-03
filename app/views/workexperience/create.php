<div class="edit-form-container"> <!-- Container voor het formulier om nieuwe werkervaring toe te voegen, met een klasse voor styling -->
    <h1>Nieuwe Werkervaring Toevoegen</h1> <!-- Hoofdtitel voor de pagina -->

    <form action="/workexperience/create" method="POST"> <!-- Begin van het formulier, verzendt een POST-verzoek naar de /workexperience/create URL -->
        <label for="company">Bedrijf:</label> <!-- Label voor het invoerveld van het bedrijf -->
        <input type="text" name="company" id="company" required> <!-- Invoerveld voor het bedrijf, verplicht veld -->

        <label for="job_title">Functie:</label> <!-- Label voor het invoerveld van de functietitel -->
        <input type="text" name="job_title" id="job_title" required> <!-- Invoerveld voor de functietitel, verplicht veld -->

        <label for="start_date">Startdatum:</label> <!-- Label voor het invoerveld van de startdatum -->
        <input type="date" name="start_date" id="start_date" required> <!-- Invoerveld voor de startdatum, verplicht veld -->

        <label for="end_date">Einddatum:</label> <!-- Label voor het invoerveld van de einddatum -->
        <input type="date" name="end_date" id="end_date"> <!-- Invoerveld voor de einddatum, niet verplicht -->

        <label for="description">Beschrijving:</label> <!-- Label voor het invoerveld van de beschrijving -->
        <textarea name="description" id="description" rows="4"></textarea> <!-- Tekstgebied voor de beschrijving, aantal rijen ingesteld op 4 -->

        <button type="submit">Toevoegen</button> <!-- Verzendenknop voor het formulier -->
    </form>

    <a href="/dashboard">Annuleer</a> <!-- Link om te annuleren en terug te gaan naar het dashboard -->
</div>
