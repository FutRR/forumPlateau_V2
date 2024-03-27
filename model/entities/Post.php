<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Category extends Entity
{

    private int $id;
    private string $contenu;
    private DateTime $dateMessage;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
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
     * Get the value of contenu
     */
    public function getContenu(): string
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */
    public function setContenu(string $contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get the value of dateMessage
     */
    public function getDateMessage(): DateTime
    {
        return $this->dateMessage;
    }

    /**
     * Set the value of dateMessage
     *
     * @return  self
     */
    public function setDateMessage(DateTime $dateMessage)
    {
        $this->dateMessage = new \DateTime($dateMessage);

        return $this;
    }


    public function __toString()
    {
        return $this->contenu;
    }

}