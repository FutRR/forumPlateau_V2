<?php
$post = $result['data']['post'];
?>
<h2>Modifier un post</h2>

<div class="container-fluid">
    <div class="col align-self-center">
        <form action="index.php?ctrl=forum&action=updatePost&id=<?= $post->getId() ?>" method="POST"
            enctype="multipart/form-data" class="mb-3 mx-auto">
            <p>
                <label class="form-label">
                    Contenu :
                    <textarea name="contenu" col='30' rows='10' class="form-control"
                        placeholder="500 caractères max."><?= $post->getContenu() ?></textarea>
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