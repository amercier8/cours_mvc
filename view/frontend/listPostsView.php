<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<header>
    <h1>Billet simple pour l'Alaska</h1>
    <div id="HeaderLinks">
        <p ><a href="index.php?displayLogin">Accéder au BackOffice</a></p>
    </div>
</header>

<?php foreach ($posts as $post): ?>
<div class="news">
    <h3>
        "<?= htmlspecialchars($post->getTitle()) ;?>"
        <em>rédigé le <?= $post->getCreation_date(); ?></em>
    </h3>
    
    <div class="chapterFront">
        <p>
            <?= $post->getContent(); ?>
        </p>
    </div>
    <a href="index.php?action=post&amp;id=<?= $post->getId(); ?>">Lire la suite</a>
</div>
<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>