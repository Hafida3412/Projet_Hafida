<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Image extends Entity{

    private $id;
    private $nomImage;
    private $altImage;
    private $logement;
    

    public function __construct($data){         
        $this->hydrate($data);        
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
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