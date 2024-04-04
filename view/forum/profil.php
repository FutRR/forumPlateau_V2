<?php
$profil = $result['data']['user'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts'];


$user = $_SESSION['user'];
if (serialize($user) == serialize($profil)) { ?>
    <div class="infos-perso">
        <h1>Votre profil</h1>
        <h3>
            <?= $user->getUsername(); ?>
            <img class="img-fluid img-thumbnail rounded w-5" src="public/img/avatar/<?= $profil->getAvatar() ?>" alt="">
        </h3>
        <p>Inscris depuis le
            <?= $user->displayRegisterDate() ?>
        </p>
        <p>Email :
            <?= $user->getEmail() ?>
        </p>
        <p></p>
    </div>

<?php } else { ?>

    <h1>
        Profil de
        <?= $profil->getUsername() ?>
    </h1>
    <img class="img-fluid img-thumbnail rounded w-5" src="public/img/avatar/<?= $profil->getAvatar() ?>" alt="">

    <p>Membre depuis le
        <?= $profil->displayRegisterDate() ?>
    </p>

<?php } ?>
<h2>Topics créés</h2>

<?php

if (isset($topics)) {

    foreach ($topics as $topic) { ?>

        <p>
            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                <?= $topic->getTitle() ?>
            </a> créé le
            <?= $topic->displayDateCreation(); ?> à
            <?= $topic->displayHeureCreation(); ?>
        </p>

        <?php
    }
} else { ?>

    <p>0 topic postés</p>

    <?php
}

?>

<h2>Posts créés</h2>

<?php if (isset($posts)) {

    foreach ($posts as $post) { ?>

        <p>
            <?= $post->getContenu() ?> publié le
            <?= $post->displayDateMessage() ?> à
            <?= $post->displayHeureMessage() ?>
            sur <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $post->getTopic()->getId() ?>">
                <?= $post->getTopic() ?>
            </a>
        </p>

    <?php }

} else { ?>

    <p>0 posts postés</p>

<?php }
