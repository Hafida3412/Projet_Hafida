<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que nous ne pouvons pas étendre, 
    c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. 
    En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Annonce extends Entity{

     // Attributs de la classe Annonce
     private $id;              // Identifiant de l'annonce
     private $dateCreation;    // Date de création de l'annonce
     private $nbChat;          // Nombre de chats (ou animaux) autorisés
     private $dateDebut;       // Date de début de disponibilité
     private $dateFin;         // Date de fin de disponibilité
     private $description;     // Description de l'annonce
     private $estValide;       // Indique si l'annonce est valide (booléen)
     private $logement;        // Détails du logement associé à l'annonce (peut-être un objet)
     private $utilisateur;     // Utilisateur ayant créé l'annonce (peut-être un objet)

    // Le constructeur initialise l'annonce en hydratant ses propriétés à partir des données fournies.
    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId() // Getter pour l'identifiant de l'annonce
    {
        return $this->id;
    }

  
    public function setId($id) // Setter pour l'identifiant de l'annonce
    {
        $this->id = $id;

        return $this;// Permet le chaînage des méthodes
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