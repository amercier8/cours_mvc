<?php $title = "Modifier le commentaire"; ?>

<?php ob_start(); ?>
<h2>Modifier le commentaire</h2>

<form action="index.php?action=modifyComment&amp;id=<?= $comment->getId(); ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?php echo $comment->getAuthor(); ?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment" ><?php echo $comment->getComment(); ?></textarea>
    </div>
    <div>
        <input type="submit" value="Modifier le commentaire"/>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>