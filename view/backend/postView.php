<?php $title = "Modifier l'article"; ?>

<?php ob_start(); ?>
<h2>Editer l'article</h2>

<form action="index.php?action=modifyPost&amp;id=<?= $post->getId(); ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?php echo $post->getTitle(); ?>" />
    </div>
    <div>
        <label for="content">Contenu de l'Article</label><br />
        <textarea id="content" name="content" ><?php echo $post->getContent(); ?></textarea>
    </div>
    <div>
        <input type="submit" value="Valider"/>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>