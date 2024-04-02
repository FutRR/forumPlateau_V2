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

                $checkEmail = $userManager->findByEmail($email) ? $userManager->findByEmail($email) : false;

                $checkUsername = $userManager->findByUsername($username) ? $userManager->findByUsername($username) : false;

                if ($checkEmail) {
                    Session::addFlash("error", "Cet email est déjà utilisé.");
                    $this->redirectTo("security", "register");
                    exit;
                }

                if ($checkUsername) {
                    Session::addFlash("error", "Ce pseudo est déjà utilisé.");
                    $this->redirectTo("security", "register");
                    exit;
                }

            } else {
                $this->redirectTo("security", "register");
                exit;
            }

        } else {
            $this->redirectTo("security", "register");
            exit;
        }

    }
    public function login()
    {
    }
    public function logout()
    {
    }
}