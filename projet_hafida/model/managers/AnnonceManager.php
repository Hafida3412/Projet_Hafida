<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;use Model\Managers\LogementManager;
use Model\Managers\UtilisateurManager;

class AnnonceManager extends Manager{

    // Déclaration de la classe POO et de la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Annonce";// Classe des entités Annonce
    protected $tableName = "annonce"; // Nom de la table en BDD

    // Constructeur qui établit la connexion à la base de données
    public function __construct(){
        parent::connect();
    }


    // REQUETE POUR COMPTER LE NOMBRE TOTAL D ANNONCES
    public function countAll() {
        $sql = "SELECT COUNT(id_annonce) as total FROM " . $this->tableName; // Requête SQL pour compter les annonces
        $result = DAO::select($sql); // Exécution de la requête
        return (int)$this->getSingleScalarResult($result); // Retourne le résultat comme un entier
    }

    
    // REQUETE POUR RECUPERER TOUTES LES ANNONCES AVEC PAGINATION
    public function findAll($order = null, $offset = 0, $perPage = PHP_INT_MAX) {
        if ($order === null) {
            $order = ['id_annonce', 'ASC'];// Ordre par défaut
        }
    // Requête SQL pour sélectionner les annonces avec un ordre et une limite de résultats
        $sql = "SELECT *
                FROM " . $this->tableName . "
                ORDER BY " . $order[0] . " " . $order[1] . "
                LIMIT " . $offset . ", " . $perPage;
        return $this->getMultipleResults(DAO::select($sql), $this->className);// Retourne les résultats
    }
    

    // REQUETE POUR AFFICHER LES ANNONCES D UN UTILISATEUR SPECIFIQUE
    public function findAnnoncesByUtilisateur($id){
        $sql = "SELECT*
        FROM ".$this->tableName. " t
        WHERE utilisateur_id = :id"; // Filtrer par ID utilisateur
    // Exécution de la requête et retour des résultats
    return  $this->getMultipleResults(
        DAO::select($sql, ['id' => $id]), //on précise "select"
        $this->className
    );
    }


     //REQUETE POUR SUPPRIMER UNE ANNONCE PAR SON ID
     public function deleteAnnonce($id) {
        $sql = "DELETE
                FROM ".$this->tableName. " t
                WHERE id_annonce = :id"; // Condition de suppression par ID
    return DAO::delete($sql, ['id' => $id]); // Exécution de la requête de suppression
    }


    // REQUETE POUR SUPPRIMER LES RESERVATIONS LIEES A UNE ANNONCE
    public function deleteReservations($annonceId) {
        $sql = "DELETE FROM reserver 
        WHERE annonce_id = :id"; // Suppression des réservations par ID d'annonce
    return DAO::delete($sql, ['id' => $annonceId]); // Exécution de la suppression
}


    // REQUETE POUR METTRE A JOUR LE STATUT DE L ANNONCE (valide)
    public function updateDisponibilite($annonceId){
        $sql = "UPDATE ".$this->tableName."
        SET estValide = 1 
        WHERE id_annonce = :id"; // Mise à jour pour rendre l'annonce valide
    return DAO::update($sql, ['id' => $annonceId]); // Exécution de la mise à jour

}
    /*REQUETE POUR VERIFIER SI L ANNONCE EST RESERVEE EN VERIFIANT SI 
    LA COLONNE "estValide" = 1 POUR L ANNONCE SELECTIONNEE*/
    public function isAnnonceValide($annonceId){
        $sql = "SELECT estValide
                FROM ".$this->tableName."
                WHERE id_annonce = :id AND estValide = 1";  // Vérification de l'état de l'annonce
    
        return $this->getSingleScalarResult(/* est appelé pour récupérer un résultat unique de la requête 
            (il retourne une seule valeur). */
            DAO::select($sql, ['id' => $annonceId], false)/* exécute la requête SQL en passant le paramètre :id 
            avec la valeur de $annonceId. La méthode select de la classe DAO exécute cette requête 
            et retourne les résultats.*/
        ) == 1; // Retourne vrai si l'annonce est valide
    }


    //REQUETE POUR AFFICHER LES ANNONCES PAR VILLE
    public function findAnnoncesByVille($ville){
    // Requête pour récupérer les annonces en fonction de la ville
    $sql = "SELECT *
            FROM ".$this->tableName." t 
            INNER JOIN logement 
            ON logement_id = logement.id_logement
            WHERE ville = :ville"; // Jointure sur la table logement

    
    return $this->getMultipleResults(
        DAO::select($sql, ['ville' => $ville]), 
        $this->className // Retourne les annonces correspondantes
    );
}


    // METHODE POUR METTRE A JOUR UNE ANNONCE AVEC DES DONNEES SPECIFIQUES
    public function update($id, $data) {
    $sql = "UPDATE " . $this->tableName . " 
            SET nbChat = :nbChat, 
                dateDebut = :dateDebut, 
                dateFin = :dateFin, 
                description = :description, 
                estValide = :estValide
            WHERE id_annonce = :id"; // Requête pour mise à jour d'une annonce

    // Exécution de la mise à jour
    return DAO::update($sql, array_merge($data, ['id' => $id]));/*La fonction array_merge garantit 
    que les données envoyées à la base de données incluent également l'identifiant de l'enregistrement
    à mettre à jour.*/
}

}
   

