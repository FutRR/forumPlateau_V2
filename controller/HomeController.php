<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class HomeController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        return [
            "view" => VIEW_DIR . "home/home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }

    public function users()
    {
        $this->restrictTo("role_admin");

        $userManager = new UserManager();
        $users = $userManager->findAll(['registerDate', 'DESC']);

        return [
            "view" => VIEW_DIR . "security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [
                "users" => $users
            ]
        ];
    }

    public function rules()
    {
        return [
            "view" => VIEW_DIR . "home/rules.php",
            "meta_description" => "Règles du forum",

        ];
    }

    public function legal()
    {
        return [
            "view" => VIEW_DIR . "home/legal.php",
            "meta_description" => "Mentions légales",

        ];
    }

}
