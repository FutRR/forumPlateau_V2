<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta
    ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>


<?php if (!isset($_SESSION['user'])) { ?>
    <p>
        <a class="btn btn-primary m-1" href="index.php?ctrl=security&action=login">Se connecter</a>
        <a class="btn btn-primary m-1" href="index.php?ctrl=security&action=register">S'inscrire</a>
    </p>
<?php } ?>