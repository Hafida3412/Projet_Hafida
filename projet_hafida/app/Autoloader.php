<?php
namespace App;

class Autoloader{

	/*Méthode statique pour enregistrer notre autoloader*/
	public static function register(){
	/* On enregistre notre méthode autoload comme fonction d'autochargement de 
	classes avec spl_autoload_register*/
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	/* Méthode statique pour charger automatiquement les classes */
	public static function autoload($class){

		//$class = Model\Managers\TopicManager (FullyQualifiedClassName)
		//namespace = Model\Managers, nom de la classe = TopicManager

		// on explose la chaîne de caractère $class en segments en fonction des \
		$parts = preg_split('#\\\#', $class);
		/*$parts contient maintenant un tableau avec les différentes parties du 
		namespace et le nom de la classe:
		  $parts = ['Model', 'Managers', 'TopicManager']*/

		// on extrait le dernier element 
		$className = array_pop($parts);
		//$className = TopicManager

		// on créé le chemin vers la classe
		// on utilise DS car plus propre et meilleure portabilité entre les différents systèmes (windows/linux) 

		$path = strtolower(implode(DS, $parts));
		//$path = 'model/manager'
		$file = $className.'.php';
		//$file = TopicManager.php

		$filepath = BASE_DIR.$path.DS.$file;
		//$filepath = model/managers/TopicManager.php
		if(file_exists($filepath)){
			require $filepath;
		}
	}
}
