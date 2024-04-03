<?php
$categories = $result["data"]['categories'];
?>

<h1>Liste des catégories</h1>

<?php
foreach ($categories as $category) { ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?= $category->getName() ?>
        </a></p>
<?php }

if (isset($_SESSION['user'])) {
    ?>

    <p>Ajouter un categorie : </p>

    <div class="container-fluid">
        <div class="col align-self-center">
            <form action="index.php?ctrl=forum&action=addCategory" method="POST" enctype="multipart/form-data"
                class="mb-3 mx-auto">
                <p>
                    <label class="form-label">
                        Nom :
                        <input type="text" name="name" class="form-control">
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        <input class="btn btn-primary" type="submit" name="submit" value="Créer">
                    </label>
                </p>
            </form>
        </div>
    </div>
<?php }


