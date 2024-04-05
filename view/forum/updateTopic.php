<?php
$topic = $result['data']['topic'];
?>
<h2>Modifier un topic</h2>

<div class="container-fluid">
    <div class="col align-self-center">
        <form action="index.php?ctrl=forum&action=updateTopic&id=<?= $topic->getId() ?>" method="POST"
            enctype="multipart/form-data" class="mb-3 mx-auto">
            <p>
                <label class="form-label">
                    Titre :
                    <input type="text" name="title" class="form-control" value="<?= $topic->getTitle() ?>">
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