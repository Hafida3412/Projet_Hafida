<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\AnnonceManager;


class ReserverManager extends Manager{
    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Reserver";
    protected $tableName = "reserver";

    public function __construct(){
        parent::connect();/*appelle la méthode connect() de la classe parente pour établir une 
    connexion à la base de données */    
    }

//METHODE POUR RECUPERER LES RESERVATIONS POUR CHAQUE UTILISATEUR
public function findReservationsByUser($id_utilisateur){
// Prépare une requête SQL pour sélectionner toutes les colonnes
// de la table spécifiée dans $this->tableName
// où la colonne 'utilisateur_id' correspond à l'identifiant de l'utilisateur donné.    
    $sql = "SELECT *
            FROM ".$this->tableName."
            WHERE utilisateur_id = :id";
// Exécute la requête SQL avec l'identifiant de l'utilisateur en tant que paramètre
// et récupère les résultats multiples sous forme d'objets de la classe spécifiée par $this->className.
    return $this->getMultipleResults(
        DAO::select($sql, ['id' => $id_utilisateur]),
        $this->className
    );
}


//METHODE POUR SUPPRIMER DES DONNEES ASSOCIEES A UN UTILISATEUR IDENTIFIE PAR SON IDENTIFIANT (userId). 
public function deleteByUserId($userId) {
    // Préparation de la requête SQL pour supprimer des enregistrements de la table spécifiée.
    // On utilise une clause WHERE pour supprimer uniquement les enregistrements correspondant à l'identifiant de l'utilisateur.
    $sql = "DELETE FROM ".$this->tableName."
            WHERE utilisateur_id = :userId";

    // Appel de la méthode DAO::delete pour exécuter la requête SQL.
    // On passe la requête $sql et un tableau associatif contenant la valeur de :userId.
    // Cette méthode exécutera la requête préparée en sécurisant les paramètres pour éviter les injections SQL.
    return DAO::delete($sql, ['userId' => $userId]);
}

}