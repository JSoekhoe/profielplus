<div class="edit-form-container"> <!-- Container voor het formulier om een nieuwe schoolprestatie toe te voegen, met een klasse voor styling -->
    <h1>Nieuwe Schoolprestatie Toevoegen</h1> <!-- Hoofdtitel voor het formulier -->

    <form action="/schoolperformance/create" method="POST"> <!-- Begin van het formulier dat verzonden wordt naar /schoolperformance/create met de POST-methode -->

        <label for="institution">School:</label> <!-- Label voor het invoerveld van de school -->
        <input type="text" name="institution" id="institution" required> <!-- Invoerveld voor de schoolnaam, verplicht -->

        <label for="degree">Diploma:</label> <!-- Label voor het invoerveld van het diploma -->
        <input type="text" name="degree" id="degree" required> <!-- Invoerveld voor het diploma, verplicht -->

        <label for="field_of_study">Studierichting:</label> <!-- Label voor het invoerveld van de studierichting -->
        <input type="text" name="field_of_study" id="field_of_study" required> <!-- Invoerveld voor de studierichting, verplicht -->

        <label for="start_date">Startdatum:</label> <!-- Label voor het invoerveld van de startdatum -->
        <input type="date" name="start_date" id="start_date" required> <!-- Invoerveld voor de startdatum, verplicht, met een datumkiezer -->

        <label for="end_date">Einddatum:</label> <!-- Label voor het invoerveld van de einddatum -->
        <input type="date" name="end_date" id="end_date"> <!-- Invoerveld voor de einddatum, niet verplicht, met een datumkiezer -->

        <label for="grade">Cijfer:</label> <!-- Label voor het invoerveld van het cijfer -->
        <input type="text" name="grade" id="grade"> <!-- Invoerveld voor het cijfer, niet verplicht -->

        <button type="submit">Toevoegen</button> <!-- Knop om het formulier in te dienen en de nieuwe schoolprestatie toe te voegen -->
    </form>

    <a href="/dashboard">Annuleer</a> <!-- Link om te annuleren en terug te gaan naar het dashboard -->
</div> <!-- Einde van de container voor het formulier -->
