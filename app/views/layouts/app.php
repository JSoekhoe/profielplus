<!DOCTYPE html>
<html lang="en"> <!-- Begin van het HTML-document met Engelse taalinstelling -->
<head>
    <meta charset="UTF-8"> <!-- Instellen van karaktercodering naar UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Voor responsive design, zorgt ervoor dat de pagina goed schaalt op mobiele apparaten -->
    <title><?php echo $title ?? 'Mijn Website'; ?></title> <!-- Dynamische titel, standaard 'Mijn Website' als er geen titel is -->
    <link rel="stylesheet" href="/public/css/styles.css"> <!-- Link naar het CSS-bestand voor de styling van de pagina -->
</head>
<body>

<header>
    <?php include __DIR__ . '/../partials/logo.php'; ?> <!-- Invoegen van het logo uit een aparte PHP-bestand -->
</header>

<nav>
    <?php include __DIR__ . '/../partials/nav.php'; ?> <!-- Invoegen van de navigatiebalk uit een aparte PHP-bestand -->
</nav>

<main>
    <?php echo $content; ?>  <!-- Dynamische inhoud voor de hoofdsectie van de pagina -->
</main>

<footer>
    <?php include __DIR__ . '/../partials/footer.php'; ?> <!-- Invoegen van de footer uit een aparte PHP-bestand -->
</footer>

<!-- Link naar het JavaScript-bestand, met 'defer' om te zorgen dat het script pas wordt uitgevoerd nadat de HTML is geladen -->
<script src="/public/js/scripts.js" defer></script>
</body>
</html>
