<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Avis extends Entity{

    private $id;
    private $dateAvis;
    private $commentaire;

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
}