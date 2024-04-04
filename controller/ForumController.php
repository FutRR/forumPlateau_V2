<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id)
    {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : " . $category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopic($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);
        $category = $categoryManager->findOneById($topic->getCategory()->getId());

        return [
            "view" => VIEW_DIR . "forum/detailsTopic.php",
            "meta_description" => "Liste des messages dans " . $topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts,
                "category" => $category,
            ]
        ];

    }

    public function userProfile($id)
    {
        $userManager = new UserManager();
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        $user = $userManager->findOneById($id);
        $topics = $topicManager->findTopicsByUser($id);
        $posts = $postManager->findPostsByUser($id);

        return [
            "view" => VIEW_DIR . "forum/profil.php",
            "meta_description" => "Profil de " . $user,
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "posts" => $posts,
            ]
        ];

    }

    public function addTopic($id)
    {
        $userManager = new UserManager();
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $userId = $_SESSION['user']->getId();

        if (isset($_SESSION['user'])) {
            if (isset($_POST['submit'])) {

                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);

                if ($title && $contenu) {

                    $idtopic = $topicManager->add(['title' => $title, 'category_id' => $id, 'user_id' => $userId]);
                    $postManager->add(['contenu' => $contenu, 'user_id' => $userId, 'topic_id' => $idtopic]);
                    header("Location: index.php?ctrl=forum&action=listTopicsByCategory&id=$id");
                    Session::addFlash('success', 'Topic créé !');
                }
            }
        }
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
        ];
    }

    public function addpost($id)
    {
        $userManager = new UserManager();
        $postManager = new PostManager();

        $userId = $_SESSION['user']->getId();

        if (isset($_SESSION['user'])) {
            if (isset($_POST['submit'])) {

                $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);

                if ($contenu) {

                    $postManager->add(['contenu' => $contenu, 'topic_id' => $id, 'user_id' => $userId]);
                    header("Location: index.php?ctrl=forum&action=listPostsByTopic&id=$id");
                    Session::addFlash('success', 'Post créé !');
                }
            }
        }
        return [
            "view" => VIEW_DIR . "forum/detailsTopic.php",
        ];
    }

    public function addCategory()
    {
        $categoryManager = new CategoryManager();

        if (isset($_SESSION['user'])) {
            if (isset($_POST['submit'])) {

                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

                if ($name) {

                    $categoryManager->add(['name' => $name]);
                    header("Location: index.php?ctrl=forum&action=index");
                    Session::addFlash('success', 'Categorie créée !');
                }
            }
        }
        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
        ];

    }

    public function deleteTopic()
    {
        $topicManager = new TopicManager();

        if (isset($_GET['cat_id']) && isset($_GET['topic_id'])) {

            $catId = $_GET['cat_id'];
            $id = $_GET['topic_id'];

            $topicManager->deleteTopic($id);
            $topicManager->delete($id);
            Session::addFlash('success', 'Topic Supprimé');
            $this->redirectTo("forum", "listTopicsByCategory", $catId);
        }
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
        ];

    }

    public function deletePost()
    {
        $postManager = new PostManager();

        if (isset($_GET['post_id']) && isset($_GET['topic_id'])) {

            $topicId = $_GET['topic_id'];
            $id = $_GET['post_id'];


            $postManager->delete($id);
            Session::addFlash('success', 'Post supprimé !');
            $this->redirectTo('forum', 'listPostsByTopic', $topicId);
        }
    }


}