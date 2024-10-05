<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UtilisateurManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Utilisateur";
    protected $tableName = "utilisateur";

    public function __construct(){
        parent::connect();
    }

    //CREATION DE LA REQUETE QUI PERMET DE VERIFIER SI L UTILISATEUR EXISTE VIA SON MAIL
    public function checkUserExists($email) {
    /*  Requête SQL pour sélectionner tous les champs d'un utilisateur
    avec une adresse e-mail correspondante*/
        $sql = "SELECT * 
                FROM " . $this->tableName . " t
                WHERE email = :email";
        // Utilisation du bon paramètre pour exécuter la requête
        return $this->getOneOrNullResult(
             // Appel à la méthode DAO::select pour exécuter la requête
             // Tout en passant l'adresse e-mail dans un tableau associatif
            DAO::select($sql, ['email' => $email], false), 
            $this->className // Indique la classe dans laquelle le résultat sera converti
        );
    }
    

    //CREATION DE LA REQUETE UPDATE POUR MODIFIER LES DONNEES PERSONNELLES DE L UTILISATEUR
    public function update($utilisateur) {
        $sql = "UPDATE ".$this->tableName."
                SET pseudo = :pseudo, email = :email, password = :password
                WHERE id_".$this->tableName." = :id";

      return $this->getOneOrNullResult(
        DAO::select($sql, [
            'pseudo' => $utilisateur->getPseudo(),
            'email' => $utilisateur->getEmail(),
            'password' => $utilisateur->getPassword(),
            'id' => $utilisateur->getId()
        ], false), //on rajoute "false" car la  public static function select dans DAO renvoie des réponses multiples "true"
        $this->className
    );
    }

    public function storeResetToken($userId, $token) {
        // Stocker le jeton dans la base de données avec une expiration / vérification ultérieure
        $sql = "UPDATE " . $this->tableName . "
                SET reset_token = :token, token_expires_at = NOW() + INTERVAL 1 HOUR
                WHERE id_utilisateur = :id";
    
        DAO::select($sql, [
            'token' => $token,
            'id' => $userId
        ]);
    }
    
    public function validateResetToken($token) {
        // Obtenir l'ID utilisateur associé au jeton de réinitialisation
        $sql = "SELECT id_utilisateur 
                FROM " . $this->tableName . " 
                WHERE reset_token = :token AND token_expires_at > NOW()";
    
        $result = DAO::select($sql, ['token' => $token]);
        return $result ? $result[0]['id_utilisateur'] : null; // Si le jeton est valide, retourner l'ID utilisateur
    }
    
    public function updatePassword($userId, $hashedPassword) {
        $sql = "UPDATE " . $this->tableName . " SET password = :password WHERE id_utilisateur = :id";
        
        return DAO::select($sql, [
            'password' => $hashedPassword,
            'id' => $userId
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->tableName . "
                WHERE id_utilisateur = :id";
        
        return DAO::delete($sql, ['id' => $id]);
    }    
    
}

