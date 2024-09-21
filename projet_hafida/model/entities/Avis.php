<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Avis extends Entity{

    // Propriétés de la classe Avis
    private $id;            // Identifiant de l'avis
    private $dateAvis;      // Date de l'avis
    private $commentaire;   // Contenu du commentaire
    private $logement;      // Logement concerné par l'avis
    private $utilisateur;   // Utilisateur ayant laissé l'avis
   

    // Constructeur qui initialise l'objet en appelant la méthode hydrate
    public function __construct($data){         
        $this->hydrate($data); // Hydrate l'objet avec les données fournies          
    }

    public function getId(){ // Getter pour l'identifiant
        return $this->id;
    }


    public function setId($id){ // Setter pour l'identifiant
        $this->id = $id;
        return $this; // Permet le chaînage des méthodes
    }

    
    public function getDateAvis()
    {
        return $this->dateAvis;
    }


    public function setDateAvis($dateAvis)
    {
        $this->dateAvis = $dateAvis;

        return $this;
    }

   
    public function getCommentaire()
    {
        return $this->commentaire;
    }


    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

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