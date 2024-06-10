<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TypeLogementManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\TypeLogement";
    protected $tableName = "typeLogement";

    public function __construct(){
        parent::connect();
    }
}