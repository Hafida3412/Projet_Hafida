<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

// Déclaration de la classe TypeLogement qui est finale et hérite de la classe Entity
final class TypeLogement extends Entity{

    // Propriétés de la classe
    private $id;          // Identifiant unique du type de logement
    private $nomType;     // Nom du type de logement

    // Constructeur qui initialise l'objet avec les données fournies
    public function __construct($data){         
        $this->hydrate($data);  // Hydrate l'objet avec les données   
    }

    // Méthode pour récupérer l'identifiant du type de logement
    public function getId()
    {
        return $this->id;
    }

    // Méthode pour définir l'identifiant du type de logement
    public function setId($id)
    {
        $this->id = $id; // Affecte la valeur à l'identifiant


        return $this; // Permet le chaînage des méthodes
    }

    
    public function getNomType()
    {
        return $this->nomType;
    }

 
    public function setNomType($nomType)
    {
        $this->nomType = $nomType;

        return $this;
    }

    public function __toString()
    {
        return $this->nomType;
    }
}