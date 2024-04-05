<?php
$users = $result['data']['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php
if (!App\Session::isAdmin()) { ?>
    <h2>Loupé!</h2>
<?php } else { ?>
    <?php foreach ($users as $user) { ?>
        <ul class="container container-fluid">
            <li>
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
                if ($user->getStatus() == 0) {
                    ?>
                    <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>"
                        class="ban-btn btn btn-outline-warning">Ban</a>
                <?php } else { ?>
                    <a href="index.php?ctrl=security&action=unBan&id=<?= $user->getId() ?>"
                        class="ban-btn btn btn-outline-warning">Unban</a>
                <?php } ?>

            </li>
        </ul>
    <?php }
} ?>