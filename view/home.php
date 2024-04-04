<h1>BIENVENUE SUR LE FORUM</h1>

<p>Retrouvez vos sujets de discussion favoris, un forum plein de diversité et politiquement correct! N'hésitez pas à
    contacter notre équipe de modération pour tout soucis.</p>


<?php if (!isset($_SESSION['user'])) { ?>
    <p>
        <a class="btn btn-primary m-1" href="index.php?ctrl=security&action=login">Se connecter</a>
        <a class="btn btn-primary m-1" href="index.php?ctrl=security&action=register">S'inscrire</a>
    </p>
<?php } ?>