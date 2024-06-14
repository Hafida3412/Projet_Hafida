<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;use Model\Managers\LogementManager;
use Model\Managers\UtilisateurManager;

class AnnonceManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Annonce";
    protected $tableName = "annonce";

    public function __construct(){
        parent::connect();
    }

    //REQUETE POUR AFFICHER LES ANNONCES PAR UTILISATEUR
    public function findAnnoncesByUtilisateur($id){
        $sql = "SELECT*
        FROM ".$this->tableName. " t
        WHERE utilisateur_id = :id";
    //la requête renvoie un seul ou aucun résultat
    return  $this->getOneOrNullResult(
        DAO::delete($sql, ['id' => $id]), //on précise "delete"
        $this->className
    );
    }

     //REQUETE POUR SUPPRIMER UNE ANNONCE
     public function deleteAnnonce($id) {
        $sql = "DELETE
                FROM ".$this->tableName. " t
                WHERE id_annonce = :id";
    //la requête renvoie un seul ou aucun résultat
        return  $this->getOneOrNullResult(
            DAO::delete($sql, ['id' => $id]), //on précise "delete"
            $this->className
        );
    }
   
}
