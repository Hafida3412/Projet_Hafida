<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Annonce extends Entity{

    private $id;
    private $dateCreation;
    private $nbChat;
    private $dateDebut;
    private $dateFin;
    private $description;
    private $estValide;
    private $logement;
    private $utilisateur;


    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
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

 
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

  
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

 
    public function getNbChat()
    {
        return $this->nbChat;
    }

  
    public function setNbChat($nbChat)
    {
        $this->nbChat = $nbChat;

        return $this;
    }

 
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

   
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }


    public function getDateFin()
    {
        return $this->dateFin;
    }

 
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }

 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getEstValide()
    {
        return $this->estValide;
    }

   
    public function setEstValide($estValide)
    {
        $this->estValide = $estValide;

        return $this;
    }

    public function getLogement()
    {
        return $this->logement;
    }

    public function setLogement($logement)
    {
        $this->logement = $logement;

        return $this;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}