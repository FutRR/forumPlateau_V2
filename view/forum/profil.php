<?php
$profil = $result['data']['user'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts']
    ?>

<h1>
    Profil de
    <?= $profil->getUsername() ?>
</h1>

<h2>Topics créés</h2>

<?php

if (!isset($topics)) {

    ?>
    <p>0 topic postés</p>

    <?php

} else {

    foreach ($topics as $topic) {
        ?>

        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a> créé le
            <?= $topic->displayDateCreation(); ?> à
            <?= $topic->displayHeureCreation(); ?>
        </p>

        <?php

    }
}
?>

<h2>Posts créés</h2>

<?php if (!isset($posts)) { ?>

    <p>0 posts postés</p>

<?php } else {

    foreach ($posts as $post) {
        ?>

        <p>
            <?= $post->getContenu() ?> publié le
            <?= $post->displayDateMessage() ?> à
            <?= $post->displayHeureMessage() ?>
            sur <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $post->getTopic()->getId() ?>">
                <?= $post->getTopic() ?>
            </a>
        </p>

        <?php

    }
} ?>