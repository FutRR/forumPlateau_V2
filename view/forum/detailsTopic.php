<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<h1>
    <?= $topic->getTitle() ?>
</h1>

<?php
foreach ($posts as $post) { ?>
    <p>
        <?= $post->getContenu(); ?>
        par
        <?= $post->getUser() ?> publié le
        <?= $post->displayDateMessage() ?> à
        <?= $post->displayHeureMessage() ?>
    </p>
<?php }
