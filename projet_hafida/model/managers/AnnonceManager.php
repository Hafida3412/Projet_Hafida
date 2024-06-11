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
    // Ajoutez une méthode pour récupérer tous les avis liés à une annonce
    public function findAvisByAnnonce($id){
        $sql = "SELECT a.*
                FROM avis a
                WHERE a.logement_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            "Model\Entities\Avis"
        );
    }
}
