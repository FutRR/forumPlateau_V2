<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $meta_description ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel=" stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div class="mb-5 mx-5" id="wrapper">
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red">
                <?= App\Session::getFlash("error") ?>
            </h3>
            <h3 class="message" style="color: green">
                <?= App\Session::getFlash("success") ?>
            </h3>
            <header>
                <nav class="navbar navbar-expand-lg mb-5">
                    <div class="container-fluid d-flex align-items-center justify-content-between">

                        <div id="nav-left">
                            <a class="navbar-br home" href="index.php?ctrl=home"><img
                                    class="logo d-iflex align-items-center" src="public/img/logo/ForumV12.png"
                                    alt=""></a>
                            </li>
                            <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                href="index.php">Accueil</a></li>
                            <?php
                            // si l'utiliseur connecté est un admin
                            if (App\Session::isAdmin()) {
                                ?>
                                <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                    href="index.php?ctrl=home&action=users">Utilisateurs</a></li>
                            <?php } ?>
                            <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                href="index.php?ctrl=forum&action=index">Catégories</a></li>
                            <!-- <a id="btnSwitch" class="link-dark nav-item fs-5"><i class="fa-regular fa-moon"></i></a> -->
                        </div>

                        <div id="nav-right" class='d-flex justify-content-around align-items-center'>
                            <?php
                            // si l'utilisateur est connecté 
                            if (App\Session::getUser()) {
                                ?>
                                <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                    href="index.php?ctrl=forum&action=userProfile&id=<?= App\Session::getUser()->getId() ?>">
                                    <img class='nav-item img-thumbnail rounded w-5'
                                        style='width: 75px; height: 75px; object-fit: cover;'
                                        src="public/img/avatar/<?= App\Session::getUser()->getAvatar() ?>" alt="">
                                </a>

                                <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                    href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                <?php
                            } else {
                                ?>
                                <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                    href="index.php?ctrl=security&action=login">Connexion</a></li>
                                <a class="link-dark nav-item link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover m-1 fs-3"
                                    href="index.php?ctrl=security&action=register">Inscription</a></li>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </nav>
            </header>

            <a href="#" class="btn btn-outline-dark btn-floating btn-lg"
                style="position: fixed; bottom: 20px; right: 20px;">
                <i class="fas fa-arrow-up"></i>
            </a>

            <main id="forum" class="mt-5 mb-5">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy;
                <?= date_create("now")->format("Y") ?> - <a class="p-1 rounded"
                    href="index.php?ctrl=home&action=rules">Règlement du forum</a>
                - <a class="p-1 rounded" href="index.php?ctrl=home&action=legal">Mentions
                    légales</a>
            </p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
        </script>
    <script>
        $(document).ready(function () {
            // $(".message").each(function () {
            //     console.log($(this).text())
            //     if ($(this).text().length > 2) {
            //         $(this).slideDown(500, function () {
            //             $(this).delay(3000).slideUp(500)
            //         })
            //     }
            // })
            $(".delete-btn").on("click", function () {
                return confirm("Êtes-vous sûr de vouloir supprimer?")
            })
            $(".delete-user-btn").on("click", function () {
                return confirm("Êtes-vous sûr de vouloir supprimer vote compte ? Cette action est définitive.")
            })
            $(".ban-btn").on("click", function () {
                return confirm("Êtes-vous sûr de vouloir bannir cet utilisateur ?")
            })
            $(".unban-btn").on("click", function () {
                return confirm("Êtes-vous sûr de vouloir débannir cet utilisateur ?")
            })

            // tinymce.init({
            //     selector: '.post',
            //     menubar: false,
            //     plugins: [
            //         'advlist autolink lists link image charmap print preview anchor',
            //         'searchreplace visualblocks code fullscreen',
            //         'insertdatetime media table paste code help wordcount'
            //     ],
            //     toolbar: 'undo redo | formatselect | ' +
            //         'bold italic backcolor | alignleft aligncenter ' +
            //         'alignright alignjustify | bullist numlist outdent indent | ' +
            //         'removeformat | help',
            //     content_css: '//www.tiny.cloud/css/codepen.min.css'
            // });
        })
    </script>
    <script src="https://kit.fontawesome.com/19a031a4c5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
</body>

</html>