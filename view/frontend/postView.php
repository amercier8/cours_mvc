<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post->getTitle()); ?>
        <em>le <?= $post->getCreation_date(); ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post->getContent())); ?>
    </p>
</div>

<h2>Commentaires</h2>
<?php
//TEST
//var_dump($comments);
//FIN DE TEST
?>

<form action="index.php?action=addComment&amp;id=<?= $post->getId(); ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php foreach ($comments as $comment): ?>
<p><strong><?= htmlspecialchars($comment->getAuthor()); ?></strong> le <?= $comment->getCommentDate(); ?></p>
    <p><?= nl2br(htmlspecialchars($comment->getComment())); ?></p>
    <!-- I add a link to redirect to commentView.php (displaying a comment alone), before modifying it eventually -->
    <p><a href="index.php?action=displayComment&amp;id=<?= $comment->getId(); ?>">Editer le commentaire</a></p>

<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
