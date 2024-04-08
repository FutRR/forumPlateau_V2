<?php
$users = $result['data']['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php
if (!App\Session::isAdmin()) { ?>
    <h2>Loupé!</h2>
<?php } else { ?>
    <?php foreach ($users as $user) { ?>
        <div class="d-flex bg-light py-2 my-5 border border-dark-subtle rounded">
            <div class="d-flex m-2"> <img class="img-fluid img-thumbnail rounded w-5"
                    src="public/img/avatar/<?= $user->getAvatar() ?>" alt="" style='object-fit: cover;'>
            </div>
            <div class="d-flex flex-column">

                <?php $profil = $_SESSION['user'];
                if (serialize($user) == serialize($profil)) { ?>
                    <p> <strong>Votre profil</strong> :
                    <?php } else { ?>
                    <p>Nom d'utilisateur :
                    <?php } ?>
                    <a href="index.php?ctrl=forum&action=userProfile&id=<?= $user->getId() ?>">
                        <?= $user->getUsername() ?>
                    </a>
                </p>
                <p>Date d'Inscription :
                    <?= $user->displayRegisterDate() ?>
                </p>
                <p>Email :
                    <?= $user->getEmail() ?>
                </p>
                <?php
                if ($user->getStatus() == 0 && $user != $_SESSION['user']) {
                    ?>
                    <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>"
                        class="ban-btn btn btn-outline-warning">Ban</a>
                <?php } elseif ($user->getStatus() == 1 && $user != $_SESSION['user']) { ?>
                    <a href="index.php?ctrl=security&action=unBan&id=<?= $user->getId() ?>"
                        class="unban-btn btn btn-outline-warning">Unban</a>
                <?php } ?>
            </div>
        </div>
    <?php }
} ?>