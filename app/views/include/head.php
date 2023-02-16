<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- lista favicon con RealFaviconGenerator.net -->
<link rel="apple-touch-icon" sizes="180x180" href="<?= WEB_PATH?>/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= WEB_PATH?>/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= WEB_PATH?>/images/favicon/favicon-16x16.png">

<!-- Google APIS per fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/reset.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/style.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/main.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/buttons.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/forms.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/header.css">
<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/footer.css">
<!--<link rel="stylesheet" href="<?= WEB_PATH?>/css/global/grid.css">-->

<?php
    $path =  explode( '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[2];
    $cssUrl = "css/" . $path .".css";
    if(file_exists($cssUrl))
        echo '<link rel="stylesheet" href="' . WEB_PATH . '/' . $cssUrl .'">';
?>

<title><?= ucwords($path)?> - PBC</title>