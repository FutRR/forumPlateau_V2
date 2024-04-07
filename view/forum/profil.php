<?php
$profil = $result['data']['user'];
$topics = $result['data']['topics'];
$posts = $result['data']['posts'];

if (isset($_SESSION['user']) && $_SESSION['user'] == $profil) { ?>

    <div>
        <h1>Votre profil
            <?php
            if (App\Session::getUser() == $profil) { ?>

                <a href="index.php?ctrl=forum&action=updateProfil&id=<?= $profil->getId() ?>"
                    class="btn btn-outline-dark py=1">Modifier</a>
            <?php } ?>
        </h1>
        <h3>
            <?= $profil->getUsername(); ?>
            <img class="img-fluid img-thumbnail rounded w-5" src="public/img/avatar/<?= $profil->getAvatar() ?>" alt="">
        </h3>
        <p>Inscris depuis le
            <?= $profil->displayRegisterDate() ?>
        </p>
        <p>Email :
            <?= $profil->getEmail() ?>
        </p>
    </div>

<?php } else { ?>

    <h1>
        Profil de
        <?= $profil->getUsername() ?>
        <?php if ($_SESSION['user']->getRole() == "role_admin" && $profil->getStatus() == 0) {
            ?>
            <a href="index.php?ctrl=security&action=ban&id=<?= $profil->getId() ?>"
                class="ban-btn btn btn-outline-warning">Ban</a>
        <?php } else { ?>
            <a href="index.php?ctrl=security&action=unBan&id=<?= $profil->getId() ?>"
                class="unban-btn btn btn-outline-warning">Unban</a>
        <?php } ?>
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
