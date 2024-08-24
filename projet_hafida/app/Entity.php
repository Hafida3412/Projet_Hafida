<?php
namespace App;

// Classe abstraite Entity namespace App;
abstract class Entity{

    // Méthode pour hydrater l'objet avec les données passées en paramètre
    protected function hydrate($data){
        // Séparation du champ en deux parties s'il contient un "_"
        foreach($data as $field => $value){
            // field = topic_id
            // fieldarray = ['topic','id']
            $fieldArray = explode("_", $field);

             // Vérification si la deuxième partie du champ est "id"
            if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                // Création du nom du manager en fonction de la première partie du champ
                // manName = TopicManager 
                $manName = ucfirst($fieldArray[0])."Manager";
                // Construction du nom qualifié de la classe du manager
                // FQCName = Model\Managers\TopicManager;
                $FQCName = "Model\Managers\\".$manName;
                
                // Instanciation du manager correspondant
                // man = new Model\Managers\TopicManager
                $man = new $FQCName();

                // Récupération de l'objet associé à l'identifiant passé en valeur
                // value = Model\Managers\TopicManager->findOneById(1)
                $value = $man->findOneById($value);
            }
            
            // Construction du nom du setter à appeler en fonction de la première partie du champ
            // fabrication du nom du setter à appeler (ex: setName)
            $method = "set".ucfirst($fieldArray[0]);
            
            // Vérification si le setter existe dans l'entité
            // si setName est une méthode qui existe dans l'entité (this)
            if(method_exists($this, $method)){
                // Appel du setter avec la valeur correspondante
                // $this->setName("valeur")
                $this->$method($value);
            }
        }
    }

    // Méthode pour obtenir le nom de la classe de l'entité
    public function getClass(){
        return get_class($this);
    }
}