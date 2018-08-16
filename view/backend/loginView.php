<?php $title = "S'enregistrer"; ?>

<?php ob_start(); ?>
<h2>S'enregistrer</h2>

<form action="index.php?login" method="post">
    <div class="container">
        <label for="psw"><b>Mot de passe</b></label>
        <input type="password" placeholder="Renseignez le mot de passe" name="psw" required>
    <div>
        <input type="submit" value="Valider le mot de passe"/>
    </div>
    </div>
</form> 