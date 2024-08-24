<?php
namespace App;

abstract class Manager{
    // Méthode pour se connecter à la base de données:
    protected function connect(){
        DAO::connect();
    }

    /**
     * Récupère tous les enregistrements d'une table, triés par champ et ordre optionnels
     * 
     * @param array $order un tableau avec champ et ordre en option
     * @return Collection une collection d'objets hydratés par DAO, qui sont les résultats de la requête envoyée
     */
    public function findAll($order = null){

        // Construction de la clause ORDER BY en fonction des paramètres reçus
        $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

        // Construction de la requête SQL pour récupérer tous les enregistrements de la table
        $sql = "SELECT *
                FROM ".$this->tableName." a
                ".$orderQuery;

        // Appel de la méthode select de la classe DAO pour exécuter la requête et récupérer les résultats
        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );
    }
    
    // Méthode pour trouver un enregistrement par son identifiant
    public function findOneById($id){
        // Construction de la requête SQL pour récupérer un enregistrement par son ID
        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.id_".$this->tableName." = :id
                ";

/* 
Appel de la méthode select de la classe DAO pour exécuter la requête et récupérer 
le résultat
*/
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false), 
            $this->className
        );
    }

    // Méthode pour ajouter un nouvel enregistrement
    //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];
    public function add($data){
        //$keys = ['username' , 'password', 'email']
        $keys = array_keys($data);
        //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
        $values = array_values($data);
        //"username,password,email"

        // Construction de la requête SQL d'insertion
        $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).") 
                VALUES
                ('".implode("','",$values)."')";
                //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
        /*
            INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
        */
        try{
            // Appel de la méthode insert de la classe DAO pour exécuter la requête d'insertion
            return DAO::insert($sql);
        }
        catch(\PDOException $e){
            echo $e->getMessage();// Affichage de l'erreur PDO en cas d'échec
            die();// Arrêt de l'exécution du script
        }
    }
    
    public function delete($id){
        $sql = "DELETE FROM ".$this->tableName."
                WHERE id_".$this->tableName." = :id
                ";

        return DAO::delete($sql, ['id' => $id]); 
    }

    private function generate($rows, $class){
        foreach($rows as $row){
            yield new $class($row);
        }
    }
    
    protected function getMultipleResults($rows, $class){

        if(is_iterable($rows)){
            return $this->generate($rows, $class);
        }
        else return null;
    }

    protected function getOneOrNullResult($row, $class){

        if($row != null){
            return new $class($row);
        }
        return false;
    }

    protected function getSingleScalarResult($row){

        if($row != null){
            $value = array_values($row);
            return $value[0];
        }
        return false;
    }

}