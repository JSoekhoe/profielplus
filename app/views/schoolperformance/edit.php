<div class="edit-form-container"> <!-- Container voor het formulier om schoolprestaties te bewerken, met een klasse voor styling -->
    <h1>Bewerk Schoolprestaties</h1> <!-- Hoofdtitel voor het formulier -->

    <form method="POST" action="/schoolperformance/edit/<?php echo htmlspecialchars($performance->id); ?>"> <!-- Begin van het formulier dat verzonden wordt naar de bewerkingsactie voor de specifieke schoolprestatie -->

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($performance->id); ?>"> <!-- Verborgen invoerveld om de ID van de schoolprestatie op te slaan, zodat deze met de POST-aanroep kan worden verzonden -->

        <label for="institution">Instelling:</label> <!-- Label voor het invoerveld van de onderwijsinstelling -->
        <input type="text" name="institution" id="institution" value="<?php echo htmlspecialchars($performance->institution); ?>" required> <!-- Invoerveld voor de naam van de instelling, met de huidige waarde, verplicht -->

        <label for="degree">Diploma:</label> <!-- Label voor het invoerveld van het diploma -->
        <input type="text" name="degree" id="degree" value="<?php echo htmlspecialchars($performance->degree); ?>" required> <!-- Invoerveld voor het diploma, met de huidige waarde, verplicht -->

        <label for="field_of_study">Studierichting:</label> <!-- Label voor het invoerveld van de studierichting -->
        <input type="text" name="field_of_study" id="field_of_study" value="<?php echo htmlspecialchars($performance->field_of_study); ?>" required> <!-- Invoerveld voor de studierichting, met de huidige waarde, verplicht -->

        <label for="start_date">Startdatum:</label> <!-- Label voor het invoerveld van de startdatum -->
        <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($performance->start_date); ?>"> <!-- Invoerveld voor de startdatum, met de huidige waarde, zonder verplichting -->

        <label for="end_date">Einddatum:</label> <!-- Label voor het invoerveld van de einddatum -->
        <input type="date" name="end_date" id="end_date" value="<?php echo htmlspecialchars($performance->end_date); ?>"> <!-- Invoerveld voor de einddatum, met de huidige waarde, zonder verplichting -->

        <label for="grade">Cijfer:</label> <!-- Label voor het invoerveld van het cijfer -->
        <input type="text" name="grade" id="grade" value="<?php echo htmlspecialchars($performance->grade); ?>"> <!-- Invoerveld voor het cijfer, met de huidige waarde, zonder verplichting -->

        <button type="submit">Opslaan</button> <!-- Knop om het formulier in te dienen en de wijzigingen op te slaan -->
        <a href="/dashboard" class="cancel-button">Annuleer</a> <!-- Link om te annuleren en terug te gaan naar het dashboard -->
    </form>
</div> <!-- Einde van de container voor het formulier -->
