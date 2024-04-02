<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct()
    {
        parent::connect();
    }

    public function findByEmail($email)
    {
        $sql = 'SELECT * 
                FROM ".$this->tablename." u 
                WHERE u.email = :email';

        // la requête renvoie un ou enregistrements --> getOneOrNullResult

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );

    }

    public function findByUsername($username)
    {
        $sql = 'SELECT *
                FROM ".$this->tablename." u
                WHERE u.username = :username';

        // la requête renvoie un ou enregistrements --> getOneOrNullResult

        return $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username], false),
            $this->className
        );
    }


}