<?php $title = 'Back-Office Homepage'; ?>

<?php ob_start(); ?>
<h2>Back-Office Homepage</h2>

<p>Ici vous pouvez gérer tous les articles de votre blog!</p>
<p>Rédiger un nouvel article</p>
<form action="index.php?action=addPost" method="post">
<div>
        <label for="title">Titre du billet</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Corps du billet</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php foreach ($posts as $post): ?>
<div>
    <h3>
        <?= htmlspecialchars($post->getTitle()) ;?>
        <em>le <?= $post->getCreation_date(); ?></em>
    </h3>
    <p><a href="index.php?action=displayPost&amp;id=<?= $post->getId(); ?>">Editer l'article</a></p>
    <em><a href="index.php?action=delete&amp;id=<?= $post->getId(); ?>">Supprimer l'article</a></em>
    <p>
        <!-- <?= nl2br(htmlspecialchars($post->getContent())); ?> -->
        <br />
        <em><a href="index.php?action=post&amp;id=<?= $post->getId(); ?>">Commentaires</a></em>
        <!-- L'objectif ici est de parvenir à voir pour chaque post, si'l comporte au moins un commentaire en attente de modération et un commentaire signalé-->
        <h4>Commentaires</h4>
        

        <p>
            <?php
                foreach ($comments as $comment): ?>
                    <p> <?= $comment->getReport(); ?> </p>
                <?php endforeach;
            ?>
            
        </p>
    </p>
</div>
<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

