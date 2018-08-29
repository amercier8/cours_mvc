<?php $title = 'Back-Office Homepage'; ?>

<?php ob_start(); ?>
<h2>Back-Office Homepage</h2>

<p>Ici vous pouvez gérer tous les articles de votre blog!</p>
<p>Rédiger un nouvel article</p>

<form action="index.php?action=addPost" method="post">
    <div>
        <label for="title">Titre du billet</label><br />
        <input type="text" id="title" name="title" required/>
    </div>
    <div>
        <label for="content">Corps du billet</label><br />
        <textarea class="mytextarea" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<!-- Test sous forme de tableau -->
<table>
    <tr>
        <th>Titre du Billet</th>
        <th>Date de rédaction</th>
        <th>Commentaires en attente de modération</th>
        <th>Commentaires signalés</th>        
    </tr>
    <?php foreach ($posts as $post):
    ?>
    <tr>
        <td><a href="index.php?action=displayPost&amp;id=<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()) ;?></a></td>
        <td><?= $post->getCreation_date(); ?></td>
        
        <td>bla</td>
        <td>bla</td>
    </tr>
    <?php
    endforeach;
    ?>
</table>



<?php foreach ($posts as $post): ?>
<div>
    <h3>
        <?= htmlspecialchars($post->getTitle()) ;?>
        <em>le <?= $post->getCreation_date(); ?></em>
    </h3>
    <p>ID = <?= $post->getId();?></p>
    <p><a href="index.php?action=displayPost&amp;id=<?= $post->getId(); ?>">Editer l'article</a></p>
    <em><a href="index.php?action=delete&amp;id=<?= $post->getId(); ?>">Supprimer l'article</a></em>
    <p>
        <!-- <?= nl2br(htmlspecialchars($post->getContent())); ?> -->
        <!-- L'objectif ici est de parvenir à voir pour chaque post, si'l comporte au moins un commentaire en attente de modération et un commentaire signalé-->
        <h4>Commentaires</h4>
        <!-- TESTS -->
        <?php $postId = $post->getId();?>
        <p>
        <?php foreach ($comments as $comment):
            $commentPostId = $comment->getPostId();
            if ($commentPostId === $postId) {
                ?>
                    <p><strong><?= htmlspecialchars($comment->getAuthor()); ?></strong> le <?= $comment->getCommentDate(); ?></p>
                    <?php
                    if ($comment->getStatus() === "approved") {
                        ?>
                        <p>Commentaire modéré postivement</p>
                        <?php
                    }
                    else if ($comment->getStatus() === "disapproved") {
                        ?>
                        <p>Commentaire modéré négativement</p>
                        <?php
                    }
                    else {
                        ?>
                        <p>Vous n'avez pas encore modéré ce commentaire</p>
                        <?php
                    }
                    ?>
                    <p><a href="index.php?action=approveComment&amp;id=<?= $comment->getId(); ?>">Modérer positivement</a></p>
                    <p><a href="index.php?action=disapproveComment&amp;id=<?= $comment->getId(); ?>">Modérer négativement</a></p>
                    <?php
                    if ($comment->getReport() == true) {
                        ?>
                        <p>Signalé</p>
                        <?php
                    }
            }
        endforeach; ?>
        </p>
        <!-- -->
    </p>
</div>
<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

