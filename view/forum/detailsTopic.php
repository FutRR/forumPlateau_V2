<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
$category = $result["data"]['category'];
?>

<h3>
    <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
        <?= $category->getName() ?>
    </a>
</h3>
<h1>
    <?= $topic->getTitle() ?>
    <?php
    if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()) { ?>

        <a href="index.php?ctrl=forum&action=updateTopic&id=<?= $topic->getId() ?>"
            class="btn btn-outline-dark py=1">Modifier</a>
        <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"
            class="delete-btn btn btn-outline-danger py=1">Supprimer</a>
        <?php if ($topic->getClosed() == 0) { ?>
            <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId() ?>"
                class="delete-btn btn btn-outline-warning py=1">Fermer</a>
        <?php } elseif ($topic->getClosed() == 1) { ?>
            <a href="index.php?ctrl=security&action=openTopic&id=<?= $topic->getId() ?>"
                class="delete-btn btn btn-outline-warning py=1">Ouvrir</a>
        <?php }
    } ?>

</h1>

<?php
if (isset($posts)) {

    foreach ($posts as $post) { ?>
        <div class="d-flex bg-light py-2 my-5 border border-dark-subtle rounded"
            style="min-width: 35%; max-width: fit-content;">
            <div class="d-flex m-2"> <img class="img-fluid img-thumbnail rounded w-5"
                    src="public/img/avatar/<?= $post->getUser()->getAvatar() ?>" alt="">
            </div>
            <div class="d-flex flex-column">
                <p>
                    <?= $post->getContenu(); ?>
                </p>
                <p>par
                    <a href="index.php?ctrl=forum&action=userProfile&id=<?= $post->getUser()->getId() ?>">
                        <?= $post->getUser() ?>
                    </a> publié le
                    <?= $post->displayDateMessage() ?> à
                    <?= $post->displayHeureMessage() ?>
                </p>
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['user'])) {
                        $user = $_SESSION['user'];
                        if (serialize($user) == serialize($post->getUser()) || App\Session::isAdmin()) { ?>
                            <a class="delete-btn btn btn-outline-danger m-2"
                                href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer</i></a>
                        <?php }
                        if (serialize($user) == serialize($post->getUser())) { ?>
                            <a class="btn btn-outline-dark m-2"
                                href="index.php?ctrl=forum&action=updatePost&id=<?= $post->getId() ?>">Modifier</a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
} else { ?>
    <p>Aucun Post</p>
<?php }

if ($topic->getClosed() == 1) { ?>
    <p>Le topic est fermé - impossible de poster</p>
<?php } else if ($topic->getClosed() == 0) {

    if (isset($_SESSION['user'])) {
        ?>

            <p>Ajouter un post : </p>

            <div class="container-fluid">
                <div class="col align-self-center">
                    <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST"
                        enctype="multipart/form-data" class="mb-3 mx-auto">
                        <p>
                            <label class="form-label">
                                Contenu :
                                <textarea name="contenu" col='30' rows='10' class="form-control"
                                    placeholder="500 caractères max."></textarea>
                            </label>
                        </p>

                        <p>
                            <label class="form-label">
                                <input class="btn btn-outline-dark" type="submit" name="submit" value="Poster">
                            </label>
                        </p>
                    </form>
                </div>
            </div>
    <?php }
} ?>