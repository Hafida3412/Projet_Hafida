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

    // On ajoute cette méthode pour mettre à jour le statut de l'annonce
    public function updateDisponibilite($annonceId){
        $sql = "UPDATE ".$this->tableName.
        " SET estValide= 1 
        WHERE id_annonce = :id";//requête pour verrouiller l'annonce réservée
        return  $this->getOneOrNullResult(
            DAO::update($sql, ['id' => $annonceId]),//on précise "update"
            $this->className
        );
    }

    public function isAnnonceValide($annonceId){
        $sql = "SELECT estValide
                FROM ".$this->tableName."
                WHERE id_annonce = :id AND estValide = 1";;
    
        return $this->getSingleScalarResult(
            DAO::select($sql, ['id' => $annonceId], false)
        ) == 1;
    }

}
   

