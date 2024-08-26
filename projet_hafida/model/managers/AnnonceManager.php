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


    // METHODE POUR COMPTER LE NOMBRE TOTAL D ANNONCES
    public function countAll() {
        $sql = "SELECT COUNT(id_annonce) as total FROM " . $this->tableName;
        $result = DAO::select($sql);
        return $this->getSingleScalarResult($result);
}

    //METHODE POUR PAGINER LES ANNONCES
    public function findAll($order = null, $offset = 0, $perPage = 2) {
    $sql = "SELECT *
            FROM " . $this->tableName . "
            ORDER BY " . $order[0] . " " . $order[1] . "
            LIMIT " . $offset . ", " . $perPage;
    return $this->getMultipleResults(DAO::select($sql), $this->className);
}

    //REQUETE POUR AFFICHER LES ANNONCES PAR UTILISATEUR
    public function findAnnoncesByUtilisateur($id){
        $sql = "SELECT*
        FROM ".$this->tableName. " t
        WHERE utilisateur_id = :id";
    //la requête renvoie un seul ou aucun résultat
    return  $this->getMultipleResults(
        DAO::select($sql, ['id' => $id]), //on précise "select"
        $this->className
    );
    }

     //REQUETE POUR SUPPRIMER UNE ANNONCE
     public function deleteAnnonce($id) {
        $sql = "DELETE
                FROM ".$this->tableName. " t
                WHERE id_annonce = :id";
    //la requête renvoie un seul ou aucun résultat
     
        return DAO::delete($sql, ['id' => $id]);
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

    //On vérifie si l'annonce est réservée en vérifiant si la colonne "estValide" est égale à 1
    //pour l'annonce sélectionnée
    public function isAnnonceValide($annonceId){
        $sql = "SELECT estValide
                FROM ".$this->tableName."
                WHERE id_annonce = :id AND estValide = 1";;
    
        return $this->getSingleScalarResult(
            DAO::select($sql, ['id' => $annonceId], false)
        ) == 1;
    }
    //REQUETE POUR AFFICHER LES ANNONCES PAR VILLE
public function findAnnoncesByVille($ville){
    /*1. on sélectionne tous les colonnes des tables "annonce" et "logement"
      2. on joint les deux tables en utilisant la colonne "logement_id" de la 
    table "annonce" et la colonne "id_logement" de la table "logement"
      3. on filtre les résultats pour ne récupérer que les lignes où la ville 
    est égale à la ville que nous recherchons*/
    $sql = "SELECT *
            FROM ".$this->tableName." t 
            INNER JOIN logement 
            ON logement_id = logement.id_logement
            WHERE ville = :ville";
    
    return $this->getMultipleResults(
        DAO::select($sql, ['ville' => $ville]), 
        $this->className
    );
}

}
   

