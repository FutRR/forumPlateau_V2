<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<h1>
    <?= $topic->getTitle() ?>
</h1>

<?php
if (isset($posts)) {

    foreach ($posts as $post) { ?>
        <p>
            <?= $post->getContenu(); ?>
            - par
            <a href="index.php?ctrl=forum&action=userProfile&id=<?= $post->getUser()->getId() ?>">
                <?= $post->getUser() ?>
            </a> publié le
            <?= $post->displayDateMessage() ?> à
            <?= $post->displayHeureMessage() ?>
        </p>
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
                        <textarea name="contenu" rows='5' col='33' class="form-control"></textarea>
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        <input class="btn btn-primary" type="submit" name="submit" value="Poster">
                    </label>
                </p>
            </form>
        </div>
    </div>
<?php } ?>