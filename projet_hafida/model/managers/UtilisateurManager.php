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

    // METHODE POUR STOCKER/ENREGISTRER UN TOKEN DE REINITIALISATION
    public function storeResetToken($userId, $token) {
        // On prépare une requête pour mettre à jour le jeton de réinitialisation avec un délai d'expiration
        $sql = "UPDATE " . $this->tableName . "
                SET reset_token = :token, token_expires_at = NOW() + INTERVAL 1 HOUR
                WHERE id_utilisateur = :id";
        // On exécute la requête en passant les paramètres du jeton et de l'ID de l'utilisateur
        DAO::select($sql, [
            'token' => $token, // Le jeton de réinitialisation à stocker
            'id' => $userId    // L'identifiant de l'utilisateur pour le mettre à jour
        ]);
    }
    
    
    // METHODE POUR VALIDER UN "JETON DE REINITIALISATION"
    public function validateResetToken($token) {
        // On récupére l'ID utilisateur associé au jeton de réinitialisation
         // La requête SQL sélectionne l'ID utilisateur de la table correspondant au jeton passé,
        // tout en s'assurant que le jeton n'a pas expiré.
        $sql = "SELECT id_utilisateur 
                FROM " . $this->tableName . " 
                WHERE reset_token = :token AND token_expires_at > NOW()";
    
        // On exécute la requête en utilisant l'objet DAO pour récupérer les données
        // La variable $result contiendra les résultats de la requête.
        $result = DAO::select($sql, ['token' => $token]);
         // On vérifie si un résultat a été trouvé
         // Si un résultat existe, on retourne l'ID utilisateur, sinon on retourne null
        return $result ? $result[0]['id_utilisateur'] : null; // Si le jeton est valide, on retourne l'ID utilisateur
    }
    
    // METHODE POUR METTRE A JOUR LE MDP D UN UTILISATEUR EN FONCTION DE SON ID
    public function updatePassword($userId, $hashedPassword) {
        // Requête SQL pour mettre à jour le mot de passe dans la table
        $sql = "UPDATE " . $this->tableName . 
        " SET password = :password WHERE id_utilisateur = :id";
        // Exécute la requête en passant le mot de passe haché et l'ID de l'utilisateur
        return DAO::select($sql, [
            'password' => $hashedPassword, // Paramètre pour le mot de passe
            'id' => $userId // Paramètre pour l'ID de l'utilisateur
        ]);
    }

    // METHODE POUR SUPPRIMER UN UTILISATEUR DE LA BDD BASE SUR SON ID
    public function delete($id) {
        // Requête pour supprimer l'utilisateur de la table
        $sql = "DELETE FROM " . $this->tableName . "
                WHERE id_utilisateur = :id";
        // Exécute la requête en passant l'ID de l'utilisateur à supprimer
        return DAO::delete($sql, ['id' => $id]); // Paramètre pour l'ID de l'utilisateur
    }    
    
}

