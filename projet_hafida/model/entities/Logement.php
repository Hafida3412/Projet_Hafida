<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Logement extends Entity{

    // Propriétés de la classe Logement
    private $id;               // Identifiant unique du logement
    private $nbChambre;       // Nombre de chambres dans le logement
    private $rue;             // Adresse de la rue
    private $cp;              // Code postal
    private $ville;           // Ville
    private $image;           // Image du logement
    private $typeLogement;    // Type de logement (appartement, maison, etc.)
    private $utilisateur;     // Utilisateur associé au logement

    // Constructeur qui hydrate l'objet avec les données fournies
    public function __construct($data){         
        $this->hydrate($data);  
}

    public function getId() // Getter pour l'identifiant du logement
    {
        return $this->id;
    }

    public function setId($id) // Setter pour l'identifiant du logement
    {
        $this->id = $id;

        return $this;
    }

    public function getNbChambre()
    {
        return $this->nbChambre;
    }

    public function setNbChambre($nbChambre)
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getRue()
    {
        return $this->rue;
    }

    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    // Méthode qui renvoie l'adresse complète sous forme de chaîne
    public function getAdresseComplete()
    {
        return $this->rue." ".$this->cp." ".$this->ville;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

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

    public function getTypeLogement()
    {
        return $this->typeLogement;
    }

    public function setTypeLogement($typeLogement)
    {
        $this->typeLogement = $typeLogement;

        return $this;
    }
}