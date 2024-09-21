<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Utilisateur extends Entity{

    // Propriétés de la classe Utilisateur
    private $id;        // Identifiant unique de l'utilisateur
    private $pseudo;    // Pseudonyme de l'utilisateur
    private $email;     // Adresse e-mail de l'utilisateur
    private $password;  // Mot de passe de l'utilisateur
    private $role;      // Rôle de l'utilisateur (ex: admin, utilisateur)
    private $nom;       // Nom de l'utilisateur
    private $prenom;    // Prénom de l'utilisateur

    // Constructeur qui hydrate l'objet avec les données fournies

    public function __construct($data){         
        $this->hydrate($data);        
    }

    // Méthode pour obtenir l'identifiant de l'utilisateur
        public function getId(){
        return $this->id;
    }

    // Méthode pour définir l'identifiant de l'utilisateur
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
        }
     
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
            
        return $this;
        }
            
    public function getEmail()
    {
        return $this->email;
        }
                
    public function setEmail($email)
    {
        $this->email = $email;
                    
        return $this;
        }
        
                
    public function getPassword()
        {
        return $this->password;
        }
            
  
    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
        }
        
    public function getRole()
        {
        return $this->role;
        }

    public function setRole($role)
       {
        $this->role = $role;
                
        return $this;
        }
    
    
    public function getNom()
    {
        return $this->nom;
        }
    
    
    public function setNom($nom)
    {
        $this->nom = $nom;
        
        return $this;
        }
        
        
    public function getPrenom()
    {
        return $this->prenom;
        }
            
            
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
                
        return $this;
        }

    // Méthode pour vérifier si l'utilisateur possède un ou plusieurs rôles spécifiques
    // Méthode pour vérifier le rôle ADMIN
    public function hasRole(...$roles) {
        return in_array($this->role, $roles); // Vérifie si le rôle de l'utilisateur est dans les rôles spécifiés
    }
    
    // Méthode pour convertir l'objet en chaîne de caractères (affiche le pseudonyme)
    public function __toString() {
    return $this->pseudo;
    }

}