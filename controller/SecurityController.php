<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use App\Session;
use Model\Managers\UserManager;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "S'inscrire au forum"
        ];
    }

    public function addRegister()
    {
        if (isset($_POST["submit"])) {

            $userManager = new UserManager;

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($username && $email && $password1 && $password2) {

                // verifying if email is already taken
                if (!$userManager->findOneByEmail($email)) {

                    // verifying if username is already taken
                    if (!$userManager->findOneByUsername($username)) {

                        //verifying if password is the same on both inputs & if password is at least 5 characters long
                        if ($password1 == $password2 && strlen($password1) >= 5) {

                            $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

                            $userManager->add([
                                "username" => $username,
                                "email" => $email,
                                "password" => $passwordHash
                            ]);

                            Session::addFlash('success', 'Compte créé !');

                        } else {
                            Session::addFlash('error', 'Mot de passe invalide !');
                            $this->redirectTo('security', 'register');
                        }
                    } else {
                        Session::addFlash('error', "Nom d'utilisateur déjà pris !");
                        $this->redirectTo('security', 'register');
                    }
                } else {
                    Session::addFlash('error', "Cet adresse email est déjà utilisée !");
                    $this->redirectTo('security', 'register');
                }
            }
        }

        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "Inscription",

        ];

    }
    public function login()
    {
    }
    public function logout()
    {
    }
}