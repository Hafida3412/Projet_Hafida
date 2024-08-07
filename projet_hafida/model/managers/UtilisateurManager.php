<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UtilisateurManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Utilisateur";
    protected $tableName = "utilisateur";

    public function __construct(){
        parent::connect();
    }

    
    //CREATION DE LA REQUETE QUI PERMET DE VERIFIER SI L UTILISATEUR EXISTE VIA SON MAIL
    public function checkUserExists($email) {
        $sql ="SELECT * 
                FROM ".$this->tableName. " t
                WHERE email = :email";

        // la requête renvoie un objet ou rien --> getOneOrNullResult (cf fonctions dans Manager)
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), //on rajoute "false" car la  public static function select dans DAO renvoie des réponses multiples "true"
            $this->className
        );
    }

    //CREATION DE LA REQUETE UPDATE POUR MODIFIER LES DONNEES PERSONNELLES DE L UTILISATEUR
    public function update($utilisateur) {
        $sql = "UPDATE ".$this->tableName."
                SET pseudo = :pseudo, email = :email
                WHERE id_".$this->tableName." = :id";

      return $this->getOneOrNullResult(
        DAO::select($sql, [
            'pseudo' => $utilisateur->getPseudo(),
            'email' => $utilisateur->getEmail(),
            'id' => $utilisateur->getId()
        ], false), //on rajoute "false" car la  public static function select dans DAO renvoie des réponses multiples "true"
        $this->className
    );
    }
}

