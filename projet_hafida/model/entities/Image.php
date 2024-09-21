<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Image extends Entity{

    // Propriétés de la classe Image
    private $id;          // Identifiant de l'image
    private $nomImage;    // Nom du fichier de l'image
    private $altImage;    // Texte alternatif de l'image
    private $logement;    // Référence à l'entité logement associée à l'image

    // Constructeur qui hydrate l'objet avec les données fournies
    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId(){ // Getter pour l'identifiant de l'image
        return $this->id;
    }

    public function setId($id){ // Setter pour l'identifiant de l'image
        $this->id = $id; // Assigner l'identifiant passé en paramètre à la propriété
        return $this;    // Retourner $this pour permettre le chaînage
    }

        public function getNomImage()
    {
        return $this->nomImage;
    }
    
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
        
        return $this;
    }
    
        public function getAltImage()
    {
        return $this->altImage;
    }
        
    public function setAltImage($altImage)
    {
        $this->altImage = $altImage;
        
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
}