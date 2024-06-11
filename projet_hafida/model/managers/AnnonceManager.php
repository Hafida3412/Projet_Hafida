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
    // On ajoute une méthode pour récupérer tous les avis liés à une annonce
    public function findAvisByAnnonce($id){//requête pour récupérer les avis:
        $sql = "SELECT a.*
                FROM avis a
                WHERE a.logement_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            "Model\Entities\Avis"
        );
    }
}
