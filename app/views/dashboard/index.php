<!-- Welkomstbericht voor de gebruiker -->
<h1>Welkom op je Dashboard, <?php echo htmlspecialchars($user->username); ?>!</h1>

<!-- Profiel Sectie -->
<div class="dashboard-section" id="profile">
    <h2>Profiel</h2>
    <!-- Gebruiker naam en achternaam tonen, met een fallback voor onbekende waarden -->
    <p><strong>Naam:</strong> <?php echo htmlspecialchars($user->firstname ?? 'Onbekend') . ' ' . htmlspecialchars($user->lastname ?? ''); ?></p>
    <!-- E-mail van de gebruiker tonen, met fallback indien niet beschikbaar -->
    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($user->email ?? 'Geen e-mail opgegeven'); ?></p>
    <!-- Bio van de gebruiker tonen, met een fallback voor onbekende bio -->
    <p><strong>Bio:</strong> <?php echo htmlspecialchars($profile->bio ?? 'Geen bio beschikbaar'); ?></p>
    <!-- Telefoonnummer van de gebruiker tonen, met een fallback indien niet opgegeven -->
    <p><strong>Telefoon:</strong> <?php echo htmlspecialchars($profile->phone ?? 'Geen telefoonnummer opgegeven'); ?></p>
    <!-- Bewerken-knop om profielinformatie aan te passen -->
    <button onclick="location.href='/profile/edit'">Bewerken</button>
</div>

<!-- Schoolprestaties Sectie -->
<div class="dashboard-section" id="education">
    <h2>Schoolprestaties</h2>
    <table>
        <thead>
        <tr>
            <th>School</th>
            <th>Diploma</th>
            <th>Studierichting</th>
            <th>Startdatum</th>
            <th>Einddatum</th>
            <th>Cijfer</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <!-- Controleren of er schoolprestaties beschikbaar zijn -->
        <?php if (!empty($schoolperformance)): ?>
            <!-- Loopen door elke schoolprestatie en informatie tonen in een tabelrij -->
            <?php foreach ($schoolperformance as $edu): ?>
                <tr>
                    <td><?php echo htmlspecialchars($edu['institution'] ?? 'Onbekend'); ?></td>
                    <td><?php echo htmlspecialchars($edu['degree'] ?? 'Geen diploma opgegeven'); ?></td>
                    <td><?php echo htmlspecialchars($edu['field_of_study'] ?? 'Geen studierichting opgegeven'); ?></td>
                    <td><?php echo htmlspecialchars($edu['start_date'] ?? 'Geen startdatum opgegeven'); ?></td>
                    <td><?php echo htmlspecialchars($edu['end_date'] ?? 'Geen einddatum opgegeven'); ?></td>
                    <td><?php echo htmlspecialchars($edu['grade'] ?? 'Geen cijfer opgegeven'); ?></td>
                    <!-- Bewerken-knop voor specifieke schoolprestatie -->
                    <td>
                        <button onclick="location.href='/schoolperformance/edit/<?php echo htmlspecialchars($edu['id']); ?>'">Bewerken</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Bericht tonen als er geen schoolprestaties beschikbaar zijn -->
            <tr>
                <td colspan="7">Geen schoolprestaties gevonden.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <!-- Knop om een nieuwe schoolprestatie toe te voegen -->
    <button onclick="location.href='/schoolperformance/create'">Nieuwe Schoolprestatie Toevoegen</button>
</div>

<!-- Werkervaring Sectie -->
<div class="dashboard-section" id="experience">
    <h2>Werkervaring</h2>
    <table>
        <thead>
        <tr>
            <th>Werkgever</th>
            <th>Functietitel</th>
            <th>Datums</th>
            <th>Omschrijving</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <!-- Controleren of er werkervaringen beschikbaar zijn -->
        <?php if (!empty($workexperience)): ?>
            <!-- Loopen door elke werkervaring en informatie tonen in een tabelrij -->
            <?php foreach ($workexperience as $exp): ?>
                <tr>
                    <td><?php echo htmlspecialchars($exp['company'] ?? 'Onbekend'); ?></td>
                    <td><?php echo htmlspecialchars($exp['job_title'] ?? 'Geen functietitel opgegeven'); ?></td>
                    <td><?php echo htmlspecialchars($exp['start_date'] ?? 'NVT'); ?></td>
                    <td><?php echo htmlspecialchars($exp['description'] ?? 'NVT'); ?></td>
                    <!-- Bewerken-knop voor specifieke werkervaring -->
                    <td>
                        <button onclick="location.href='/workexperience/edit/<?php echo htmlspecialchars($exp['id']); ?>'">Bewerken</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Bericht tonen als er geen werkervaringen beschikbaar zijn -->
            <tr>
                <td colspan="4">Geen werkervaring gevonden.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <!-- Knop om een nieuwe werkervaring toe te voegen -->
    <button onclick="location.href='/workexperience/create'">Nieuwe Werkervaring Toevoegen</button>
</div>

<!-- Hobby's Sectie -->
<div class="dashboard-section" id="hobbies">
    <h2>Hobby's</h2>
    <table>
        <thead>
        <tr>
            <th>Hobby</th>
            <th>Beschrijving</th>
            <th>Afbeelding</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <!-- Controleren of er hobby's beschikbaar zijn -->
        <?php if (!empty($hobbies)): ?>
            <!-- Loopen door elke hobby en informatie tonen in een tabelrij -->
            <?php foreach ($hobbies as $hobby): ?>
                <tr>
                    <td><?php echo htmlspecialchars($hobby->name ?? 'Onbekend'); ?></td>
                    <td><?php echo htmlspecialchars($hobby->description ?? 'Geen beschrijving beschikbaar'); ?></td>
                    <td>
                        <!-- Controleren of er een afbeelding beschikbaar is voor de hobby -->
                        <?php if (!empty($hobby->image_url)): ?>
                            <img src="<?php echo htmlspecialchars($hobby->image_url); ?>" alt="<?php echo htmlspecialchars($hobby->name); ?>" width="50">
                        <?php else: ?>
                            Geen afbeelding beschikbaar
                        <?php endif; ?>
                    </td>
<!--                    Bewerken-knop voor specifieke hobby-->
                    <td>
                        <button onclick="location.href='/hobbies/edit/<?php echo $hobby->id; ?>'">Bewerken</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Bericht tonen als er geen hobby's beschikbaar zijn -->
            <tr>
                <td colspan="4">Geen hobby's gevonden.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <!-- Knop om een nieuwe hobby toe te voegen -->
    <button onclick="location.href='/hobbies/create'">Nieuwe Hobby Toevoegen</button>
</div>
