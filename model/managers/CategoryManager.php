<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct()
    {
        parent::connect();
    }

    public function updateCategory($data, $id)
    {
        $sql = "UPDATE category
                SET " . $data . "
                WHERE category.id_category = :id";

        return DAO::update($sql, ["id" => $id]);
    }

    public function findThree($order = null)
    {
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
            FROM category
            " . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );

    }

}