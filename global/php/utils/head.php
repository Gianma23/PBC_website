<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="lorem ipsum">
<!-- lista favicon con RealFaviconGenerator.net -->
<link rel="apple-touch-icon" sizes="180x180" href="global/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="global/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="global/images/favicon/favicon-16x16.png">
<link rel="manifest" href="global/images/favicon/manifest.json">
<link rel="mask-icon" href="global/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-config" content="global/images/favicon/browserconfig.xml">
<meta name="theme-color" content="#ffffff">

<!-- Google APIS per fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="global/css/reset.css">
<link rel="stylesheet" href="global/css/style.css">
<link rel="stylesheet" href="global/css/main.css">
<link rel="stylesheet" href="global/css/header.css">
<link rel="stylesheet" href="global/css/footer.css">
<link rel="stylesheet" href="global/css/grid.css">
<?php
    $cssUrl = "pages/".basename($_SERVER['PHP_SELF'], ".php")."/".basename($_SERVER['PHP_SELF'], ".php").".css";
    if(file_exists($cssUrl))
        echo "<link rel=\"stylesheet\" href=\"$cssUrl\">";
?>

