<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <h1>BackOffice</h1>
        <p><a href="index.php?action=disconnect">Se déconnecter</a></p>
        <?= $content ?>
    </body>
</html>