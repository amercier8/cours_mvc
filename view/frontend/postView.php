<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>
<header>
    <h1><a href="index.php">Billet simple pour l'Alaska, par Jean Forteroche</a></h1>
    <div id="HeaderLinks">
        <a href="index.php?displayLogin">Accéder au BackOffice</a>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</header>

<div class="news">
    <h2>
        "<?= htmlspecialchars($post->getTitle()); ?>"
        <em>, publié le <?= $post->getCreation_date(); ?></em>
    </h2>
    <div class="chapterFrontPost">
        <?= $post->getContent(); ?>
    </div>
</div>

<h2>Rédiger un nouveau commentaire</h2>
<?php

?>
<div class="commentFrontForm">
    <form action="index.php?action=addComment&amp;id=<?= $post->getId(); ?>" method="post">
        <div>
            <label for="author">Votre nom</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Votre commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
</div>

<h2>Commentaires publiés</h2>
<?php foreach ($comments as $comment):
?>
    <?php
    if ($comment->getStatus() !== "disapproved") {
        ?>
        <div class="comment">
            <div class="commentBOHeader">
                <p>Rédigé par <strong><?= htmlspecialchars($comment->getAuthor()); ?></strong>, le <?= $comment->getCommentDate(); ?></p>
            </div>
            <p class="commentContentBO"><?= nl2br(htmlspecialchars($comment->getComment())); ?></p>
            <!-- I add a link to redirect to commentView.php (displaying a comment alone), before modifying it eventually -->
            <!-- <p><a href="index.php?action=displayComment&amp;id=<?= $comment->getId(); ?>">Editer le commentaire</a></p> -->
            <?php
            if (!$comment->getReport() && $comment->getStatus() == "pending") {
                ?>
                <p><a href="index.php?action=reportComment&amp;id=<?= $comment->getId(); ?>">Signaler le commentaire</a></p>
                <?php
            }
            
    }
    ?>
    </div>
<?php
endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
