<?php $title = 'Back-Office Homepage'; ?>

<?php ob_start(); ?>
<header>
    <h1><a href="index.php?action=displayDashboard">BackOffice - Billet simple pour l'Alaska</a></h1>
    <div id="HeaderLinks">
        <p><a href="index.php">Accéder au Blog</a></p>
        <p><a href="index.php?action=disconnect">Se déconnecter</a></p>
    </div>
</header>

<div class="articleForm">
    <h2>Rédiger un nouvel article --</h2>

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
            <input id="homeBOSubmit" type="submit" />
        </div>
    </form>
</div>

<h2>Articles</h2>
<table id="postsBO">
    <tr>
        <th>Titre du Billet</th>
        <th>Date de rédaction</th>
        <th>À modérer</th>
        <th>Commentaires signalés</th>        
    </tr>
    <?php foreach ($posts as $post):
    ?>
    <tr>
        <td><a href="index.php?action=displayPost&amp;id=<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()) ;?></a></td>
        <td><?= $post->getCreation_date(); ?></td>
        <td class="moderationPendingNumber"><?= $commentsResume[$post->getId()]['moderationPending']; ?></td>
        <td class="signaledCommentsNumber"><?= $commentsResume[$post->getId()]['signaled']; ?></td>
    </tr>
    <?php
    endforeach;
    ?>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

