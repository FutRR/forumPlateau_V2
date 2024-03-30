<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        if (isset($_POST['submit'])) {
            $pdo = new \PDO("mysql:host=localhost;dbname=forumplateau_v2;charset=utf8", "root", "");

            $username = filter_var(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password1 = filter_var(INPUT_POST, 'password1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_var(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($username && $email && $password1 && $password2) {
                var_dump('ok');
                die;
            }

        }

        return [
            "view" => VIEW_DIR . "forum/register.php",
            "meta_description" => "S'inscrire au forum"
        ];
    }
    public function login()
    {
    }
    public function logout()
    {
    }
}