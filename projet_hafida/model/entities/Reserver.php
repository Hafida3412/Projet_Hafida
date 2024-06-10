<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Reserver extends Entity{

    private $id;
    private $valide;
    private $numeroTelephone;
    private $nbAdultes;
    private $nbEnfants;
    private $paiement;
    private $question;

    public function __construct($data){         
        $this->hydrate($data);  

}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getValide()
    {
        return $this->valide;
    }

    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    public function getNbAdultes()
    {
        return $this->nbAdultes;
    }

    public function setNbAdultes($nbAdultes)
    {
        $this->nbAdultes = $nbAdultes;

        return $this;
    }

    public function getNbEnfants()
    {
        return $this->nbEnfants;
    }

    public function setNbEnfants($nbEnfants)
    {
        $this->nbEnfants = $nbEnfants;

        return $this;
    }

    public function getPaiement()
    {
        return $this->paiement;
    }
 
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }
}