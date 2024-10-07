<?php
namespace App;

/**
 * Classe d'accès aux données de la BDD, abstraite
 * 
 * @property static $bdd l'instance de PDO que la classe stockera lorsque connect() sera appelé
 *
 * @method static connect() connexion à la BDD
 * @method static insert() requètes d'insertion dans la BDD
 * @method static select() requètes de sélection
 */
abstract class DAO{

    // Paramètres de connexion à la base de données
    private static $host   = 'mysql:host=127.0.0.1;port=3306'; // Hôte et port de la BDD
    private static $dbname = 'projet_hafida';// Nom de la base de données
    private static $dbuser = 'root';// Nom d'utilisateur pour se connecter à la BDD
    private static $dbpass = '';// Mot de passe pour l'utilisateur

    private static $bdd; // Instance de PDO pour la connexion à la BDD

    /**
     * Méthode de connexion à la base de données
     * Cette méthode crée l'unique instance de PDO de l'application
     */
    public static function connect(){
        // Initialisation de l'instance PDO avec les paramètres définis
        self::$bdd = new \PDO(
            self::$host.';dbname='.self::$dbname,
            self::$dbuser,
            self::$dbpass,
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", // Définit le jeu de caractères à UTF-8
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,// Active le mode d'exception pour les erreurs
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC // Définit le mode de récupération par défaut à FETCH_ASSOC
            )   
        );
    }

    /**
    * Méthode pour exécuter des requêtes d'insertion
    * 
    * @param string $sql Requête SQL d'insertion
    * @return string L'identifiant de l'enregistrement ajouté en base, ou null en cas d'erreur
    */

    public static function insert($sql){
        try{
            $stmt = self::$bdd->prepare($sql);// Prépare la requête d'insertion
            $stmt->execute(); // Exécute la requête
            //on renvoie l'id de l'enregistrement qui vient d'être ajouté en base, 
            //pour s'en servir aussitôt dans le controleur
            return self::$bdd->lastInsertId();
            
        }
        catch(\Exception $e){
            // Affiche le message d'erreur en cas d'exception
            echo $e->getMessage();
        }
    }

    /**
    * Méthode pour exécuter des requêtes d'update
    * 
    * @param string $sql Requête SQL d'update
    * @param mixed $params Les paramètres de la requête
    * @return boolean Etat de l'exécution de la requête (true ou false)
    */

    public static function update($sql, $params){ // Prépare la requête d'update
        try{
            $stmt = self::$bdd->prepare($sql);
            
            //on renvoie l'état du statement après exécution (true ou false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
            // Affiche le message d'erreur en cas d'exception
            echo $e->getMessage();
        }
    }
    
    /**
    * Méthode pour exécuter des requêtes de suppression
    * 
    * @param string $sql Requête SQL de suppression
    * @param mixed $params Les paramètres de la requête
    * @return boolean Etat de l'exécution de la requête (true ou false)
    */

    public static function delete($sql, $params){ // Prépare la requête de suppression
        try{
            $stmt = self::$bdd->prepare($sql);
            
            //on renvoie l'état du statement après exécution (true ou false)
            return $stmt->execute($params);
            
        }
        catch(\Exception $e){
             // Affiche la requête et le message d'erreur
            echo $sql;
            echo $e->getMessage();
            die();// Arrête le script en cas d'erreur
        }
    }

    /**
     * Cette méthode permet les requêtes de type SELECT
     * 
     * @param string $sql La chaîne de caractère contenant la requête elle-même
     * @param mixed $params=null Les paramètres de la requête
     * @param bool $multiple=true Vrai si le résultat est composé de plusieurs enregistrements (défaut), false si un seul résultat doit être récupéré
     * 
     * @return array|null Les enregistrements en FETCH_ASSOC ou null si aucun résultat
     */

    public static function select($sql, $params = null, bool $multiple = true):?array 
    {
        try{
            $stmt = self::$bdd->prepare($sql);// Prépare la requête SELECT
            $stmt->execute($params);// Exécute la requête
            
             // Récupère les résultats en fonction de la valeur de $multiple
            $results = ($multiple) ? $stmt->fetchAll() : $stmt->fetch();

            $stmt->closeCursor();// Libère le curseur de la requête
            return ($results == false) ? null : $results;// Renvoie null si aucun résultat, sinon les résultats
        }
        catch(\Exception $e){
            // Affiche le message d'erreur en cas d'exception
            echo $e->getMessage();
        }
    }
}