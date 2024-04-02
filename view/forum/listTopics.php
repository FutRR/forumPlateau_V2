<?php
$category = $result["data"]['category'];
$topics = $result["data"]['topics'];
?>

<h1>Liste des topics</h1>

<?php

if (isset($topics)) {

    foreach ($topics as $topic) { ?>
        <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a> par
            <a href="index.php?ctrl=forum&action=userProfile&id=<?= $topic->getUser()->getId() ?>">
                <?= $topic->getUser() ?>
            </a> / créé le
            <?= $topic->displayDateCreation(); ?> à
            <?= $topic->displayHeureCreation(); ?>
        </p>
    <?php }
} else { ?>
    <p>Aucun Topic</p>
<?php }
