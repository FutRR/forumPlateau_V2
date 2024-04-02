<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<h1>
    <?= $topic->getTitle() ?>
</h1>

<?php
if (isset($topic)) {

    foreach ($posts as $post) { ?>
        <p>
            <?= $post->getContenu(); ?>
            par
            <a href="index.php?ctrl=forum&action=userProfile&id=<?= $topic->getUser()->getId() ?>">
                <?= $topic->getUser() ?>
            </a> publié le
            <?= $post->displayDateMessage() ?> à
            <?= $post->displayHeureMessage() ?>
        </p>
    <?php }
} else { ?>
    <p>Aucun Topic</p>
<?php }
