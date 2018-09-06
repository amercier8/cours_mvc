<!-- <?php $title = 'Billet simple pour l\'Alaska'; ?> -->

<?php ob_start(); ?>
<header>
    <h1><a href="index.php">Billet simple pour l'Alaska, par Jean Forteroche</a></h1>
    <div id="HeaderLinks">
        <a href="index.php?displayLogin">Accéder au BackOffice</a>
    </div>
</header>

<?php foreach ($posts as $post): ?>
<div class="news">
    <h2>
        "<?= htmlspecialchars($post->getTitle()) ;?>"
        <em>, publié le <?= $post->getCreation_date(); ?></em>
    </h2>
    
    <div class="chapterFrontHome">
        <?= $post->getContent(); ?>
    </div>
    <a href="index.php?action=post&amp;id=<?= $post->getId(); ?>">Lire la suite</a>
</div>
<?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>