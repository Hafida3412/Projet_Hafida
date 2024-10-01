<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;


class LogementManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Logement";// Classe qui représente un logement
    protected $tableName = "logement";// Nom de la table dans la base de données

    public function __construct(){
         // Appel du constructeur parent pour établir la connexion à la base de données
        parent::connect();
    }
  
    // Méthode qui récupère la liste des logements pour un utilisateur spécifique, identifié par son ID
    public function listLogementsByUser($id){
        // Requête SQL pour sélectionner tous les logements associés à un utilisateur donné
        $sql = "SELECT * 
        FROM ".$this->tableName." 
        WHERE utilisateur_id = :id"; // Condition pour filtrer par ID d'utilisateur

         // Exécution de la requête et récupération des résultats sous forme de tableau d'objets de la classe correspondante
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), // Exécution de la requête avec le paramètre de l'ID utilisateur
            $this->className // Spécification de la classe à laquelle les résultats doivent être mappés
        );

    }
    
    }
    

    
    


    



