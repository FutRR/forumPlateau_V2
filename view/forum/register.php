<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>

<body>

    <div class="container-fluid">
        <div class="col align-self-center">
            <form action="index.php?ctrl=security&action=register" method="POST" enctype="multipart/form-data"
                class="mb-3 mx-auto">
                <p>
                    <label class="form-label">
                        Nom d'utilisateur :
                        <input type="text" name="username" class="form-control">
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        Email :
                        <input type="email" name="email" placeholder="azerty@gmail.com" class="form-control">
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        Mot de passe :
                        <input type="password" name="password1" class="form-control">
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        Confirmer le mot de passe :
                        <input type="password" name="password2" class="form-control">
                    </label>
                </p>

                <p>
                    <label class="form-label">
                        <input class="btn btn-primary" type="submit" value="S'inscrire">
                    </label>
                </p>
            </form>
        </div>
    </div>

</body>

</html>