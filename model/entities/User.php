<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity
{

    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private \DateTime $registerDate;
    private string $role;


    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of registerDate
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set the value of registerDate
     *
     * @return  self
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = new \DateTime($registerDate);

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    public function displayRegisterDate()
    {
        $date = $this->getRegisterDate();
        return $date->format('d/m/Y');
    }

    public function __toString()
    {
        return $this->username;
    }


    public function hasRole($role)
    {
        if ($this->getRole() == $role) {
            return true;
        }
    }


}