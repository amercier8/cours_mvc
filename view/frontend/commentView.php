<?php $title = "Modifier le commentaire"; ?>
<?php echo 'yo'; ?>
<?php echo $_GET['id']; ?>

    <!-- I add a link to redirect to commentView.php (displaying a comment alone), before modifying it eventually -->

<h2>Modifier le commentaire</h2>

<form action="index.php?action=modifyComment&amp;id=<?= $_GET['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="Com" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php require('template.php'); ?>