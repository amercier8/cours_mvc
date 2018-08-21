<?php $title = "Back-Office Homepage"; ?>

<?php ob_start(); ?>
<h2>Back-Office Homepage</h2>

<p>Bienvenue sur le backoffice</p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

