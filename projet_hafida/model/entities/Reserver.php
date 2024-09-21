<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas 
    étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une 
    classe finale ne peut pas être utilisée comme classe parente.
*/

/*
   La classe Reserver représente une réservation avec plusieurs attributs
   associés à des réservations dans une application. Cette classe est finale,
   ce qui signifie qu'elle ne peut pas être étendue.
*/

 final class Reserver extends Entity{

    // Attributs de la classe représentant les informations de réservation
    private $id; // Identifiant unique de la réservation
    private $valide; // Indicateur de la validité de la réservation (true/false)
    private $numeroTelephone; // Numéro de téléphone lié à la réservation
    private $nbAdultes; // Nombre d'adultes pour la réservation
    private $nbEnfants; // Nombre d'enfants pour la réservation
    private $paiement; // Détails du paiement pour la réservation
    private $question; // Questions supplémentaires posées par l'utilisateur
    private $utilisateur; // Information sur l'utilisateur qui a fait la réservation
    private $annonce; // Annonce associée à la réservation

    
/*Constructeur de la classe Reserver.
Il initialise les attributs de la classe en utilisant les données fournies.*/
    
     public function __construct($data){         
        $this->hydrate($data);  

}

/* Getter et Setter pour chaque attribut */
    /*Ces méthodes permettent d'accéder et de modifier les attributs de la classe */

    public function getId()  // Retourne l'identifiant de la réservation
    {
        return $this->id;
    }

    public function setId($id) // Définit l'identifiant de la réservation
    {
        $this->id = $id; // Permet le chaînage des méthodes

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

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getAnnonce()
    {
        return $this->annonce;
    }

    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }
}