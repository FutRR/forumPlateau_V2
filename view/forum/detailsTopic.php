<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
$category = $result["data"]['category'];
?>

<h3>
    <a href="index.php?ctrl=forum&action=listTopicsByCatgeory&id=<?= $category->getId() ?>">
        <?= $category->getName() ?>
    </a>
</h3>
<h1>
    <?= $topic->getTitle() ?>
</h1>

<?php
if (isset($posts)) {

    foreach ($posts as $post) { ?>
        <div class="d-flex bg-light py-2 my-5 border border-dark-subtle rounded">
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

                <?php
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    if (serialize($user) == serialize($post->getUser())) { ?>
                        <a class='delete-btn btn btn-outline-danger p-1'
                            href="index.php?ctrl=forum&action=deletePost&post_id=<?= $post->getId() ?>&topic_id=<?= $topic->getId(); ?>">Supprimer</i></a>
                    <?php }
                } ?>
            </div>
        </div>
    <?php }
} else { ?>
    <p>Aucun Post</p>
<?php }

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
                        <textarea name="contenu" col='30' rows='10' class="form-control"></textarea>
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
<?php } ?>