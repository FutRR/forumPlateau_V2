<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\DAO;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        return [
            "view" => VIEW_DIR . "forum/register.php",
            "meta_description" => "S'inscrire au forum"
        ];
    }

    public function addRegister()
    {
        if (isset($_POST["submit"])) {


            $username = filter_var(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password1 = filter_var(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_var(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($username && $email && $password1 && $password2) {
                
            }

        }

    }
    public function login()
    {
    }
    public function logout()
    {
    }
}