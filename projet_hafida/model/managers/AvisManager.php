<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class AvisManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Avis";
    protected $tableName = "avis";

    public function __construct(){
        parent::connect();
    }

    // On ajoute une méthode pour récupérer tous les avis liés à une annonce
    public function findAvisByLogement($id){//requête pour récupérer les avis:
        $sql = "SELECT a.*
                FROM avis a
                WHERE a.logement_id = :id
                ORDER BY dateAvis DESC";

        // Appel de la méthode getMultipleResults pour récupérer plusieurs résultats
    return $this->getMultipleResults(
    // Exécution d'une requête SQL via la méthode select de la classe DAO
    DAO::select($sql, ['id' => $id]), 
    // Spécification de la classe à utiliser pour mapper les résultats
    $this->className
);
    }
}