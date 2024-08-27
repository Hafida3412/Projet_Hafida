<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Image extends Entity{

    private $id;
    private $nom_image;
    private $alt_image;

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
    
    public function getNom_image()
    {
        return $this->nom_image;
    }

    public function setNom_image($nom_image)
    {
        $this->nom_image = $nom_image;

        return $this;
    }


    public function getAlt_image()
    {
        return $this->alt_image;
    }


    public function setAlt_image($alt_image)
    {
        $this->alt_image = $alt_image;

        return $this;
    }
}