<?php $title = "Accéder au Back-Office"; ?>

<?php ob_start(); ?>
<header>
    <h1>Accéder au Back-Office</h1>
    <div id="HeaderLinks">
        <p><a href="index.php">Accéder au Blog</a></p>
    </div>
</header>

<form action="index.php?login" method="post">
    <div class="container">
        <label for="psw"><b>Mot de passe</b></label>
        <input type="password" placeholder="Renseignez le mot de passe" name="psw" required/>
        <input type="submit" value="Valider le mot de passe"/>
    </div>
</form> 

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

