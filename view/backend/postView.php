<?php $title = "Modifier l'article"; ?>

<?php ob_start(); ?>
<header id="BOHeader">
<h1><a href="index.php?action=displayDashboard">BackOffice</a></h1>
    <div id="BOHeaderLinks">
        <p><a href="index.php">Accéder au Blog</a></p>
        <p><a href="index.php?action=disconnect">Se déconnecter</a></p>
    </div>
</header>

<div class="articleForm">
    <h2>Editer l'article --</h2>

    <form action="index.php?action=modifyPost&amp;id=<?= $post->getId(); ?>" method="post">
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" value="<?php echo $post->getTitle(); ?>" />
        </div>
        <div>
            <label for="content">Contenu de l'Article</label><br />
            <textarea class="mytextarea" name="content" ><?php echo $post->getContent(); ?></textarea>
        </div>
        <div id="formButtons">
            <input id="ValidateButton" type="submit" value="Valider"/>
            <em id="postSuppressionBO"><a href="index.php?action=delete&amp;id=<?= $post->getId(); ?>">Supprimer l'article</a></em>
        </div>
    </form>
</div>
<div id="BOHeaderComments">
    <h2>Commentaires</h2>
</div>
<?php foreach ($comments as $comment):
    //TESTS
    //FIN TESTS
    $commentPostId = $comment->getPostId();
    if ($commentPostId === $postId) {
        ?>
            <div class="comment">
                <div class="commentBOHeader">
                    <p>Ecrit par <?= ($comment->getAuthor()); ?>, le <?= $comment->getCommentDate(); ?></p>
                    <?php
                    if ($comment->getStatus() === "approved") {
                        ?>
                        <p class="approved">Statut : Validé</p>
                        <?php
                    }
                    else if ($comment->getStatus() === "disapproved") {
                        ?>
                        <p class="disapproved">Statut : Non approuvé</p>
                        <?php
                    }
                    else {
                        ?>
                        <p class="pending">Statut : En attente de modération</p>
                        <?php
                    }
                    ?>
                </div>
                <p class="commentContentBO"><?= htmlspecialchars($comment->getComment()); ?></p>
                <div class="moderationActionsBO">
                    <p>
                        <a href="index.php?action=approveComment&amp;id=<?= $comment->getId(); ?>">Modérer positivement</a>
                        <i class="fas fa-thumbs-up"></i>
                    </p>
                    <p>
                        <a href="index.php?action=disapproveComment&amp;id=<?= $comment->getId(); ?>">Modérer négativement</a>
                        <i class="fas fa-thumbs-down"></i>
                    </p>
                </div>
                <?php
                if ($comment->getReport() == true) {
                    ?>
                    <p>
                        Signalé
                        <i class="fas fa-exclamation-triangle"></i>
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
endforeach; ?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>