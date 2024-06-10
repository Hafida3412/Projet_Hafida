<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TypeManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Type";
    protected $tableName = "type";

    public function __construct(){
        parent::connect();
    }
}