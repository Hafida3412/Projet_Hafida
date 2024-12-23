<?php
namespace App;
/*
Ce fichier est le point d'entrée de notre application et sert à gérer les 
requêtes HTTP en utilisant le modèle MVC (Modèle-Vue-Contrôleur).
*/

/*
DEFINITION DES CONSTANTES: Il définit les constantes telles que le caractère 
séparateur de dossier, les chemins des dossiers de vues, des fichiers publics, 
le contrôleur par défaut, et l'email de l'administrateur.
*/

define('DS', DIRECTORY_SEPARATOR); // le caractère séparateur de dossier (/ ou \)
// meilleure portabilité sur les différents systêmes.
define('BASE_DIR', dirname(__FILE__).DS); // pour se simplifier la vie
define('VIEW_DIR', BASE_DIR."view/");   //le chemin où se trouvent les vues
define('PUBLIC_DIR', "public/");     //le chemin où se trouvent les fichiers publics (CSS, JS, IMG)

define('DEFAULT_CTRL', 'Home');//nom du contrôleur par défaut
define('ADMIN_MAIL', "admin@gmail.com");//mail de l'administrateur

require("app/Autoloader.php");

/*
INCLUSION DE LA CLASSE AUTOLOADER: Il inclut la classe Autoloader qui permet de charger 
automatiquement les classes PHP lorsqu'elles sont utilisées.
*/

Autoloader::register();

//DEMARRAGE DE LA SESSION: il démarre une session ou récupère la session actuelle

session_start();
//et on intègre la classe Session qui prend la main sur les messages en session
use App\Session as Session;


//---------REQUETE HTTP INTERCEPTEE-----------
/*
Interception de la requête HTTP : Il récupère le nom du contrôleur à appeler à partir 
de la requête HTTP et vérifie si la classe du contrôleur existe. 
S'il n'existe pas, il utilise le contrôleur par défaut.
*/

$ctrlname = DEFAULT_CTRL;//on prend le controller par défaut
//ex : index.php?ctrl=home
if(isset($_GET['ctrl'])){
    $ctrlname = $_GET['ctrl'];
}

/*Appel de la méthode du contrôleur: Il appelle la méthode du contrôleur en fonction de l'action 
spécifiée dans la requête HTTP. 
Si aucune action n'est spécifiée, il utilise une action par défaut
*/

//on construit le namespace de la classe Controller à appeller
$ctrlNS = "controller\\".ucfirst($ctrlname)."Controller";
//on vérifie que le namespace pointe vers une classe qui existe
if(!class_exists($ctrlNS)){
    //si c'est pas le cas, on choisit le namespace du controller par défaut
    $ctrlNS = "controller\\".DEFAULT_CTRL."Controller";
}
$ctrl = new $ctrlNS();

$action = "index";//action par défaut de n'importe quel contrôleur
//si l'action est présente dans l'url ET que la méthode correspondante existe dans le ctrl
if(isset($_GET['action']) && method_exists($ctrl, $_GET['action'])){
    //la méthode à appeller sera celle de l'url
    $action = $_GET['action'];
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else $id = null;
//ex : HomeController->users(null)
$result = $ctrl->$action($id);

/*--------CHARGEMENT PAGE--------*/
/*
Chargement de la page : Selon l'action effectuée, il charge la vue correspondante 
dans un buffer et inclut le layout principal pour afficher la page finale.
*/
if($action == "ajax"){ //si l'action était ajax cela signifie que l'on attend une réponse rapide sans recharger toute la page.
    //on affiche directement le return du contrôleur (càd la réponse HTTP sera uniquement celle-ci)
    echo $result;
}
else{
    ob_start();//démarre un buffer (tampon de sortie):capture tout ce qui est affiché dans un tampon au lieu de l'envoyer directement au navigateur.
    $meta = $result['meta'];//Les informations sont extraites du tableau $result.
    $title = $result['title'];
    /* la vue s'insère dans le buffer qui devra être vidé au milieu du layout */
    include($result['view']);//Le code inclut une vue spécifique (un fichier de template HTML ou PHP) définie dans $result['view']. Ce contenu est placé dans le tampon.
    /* je place cet affichage dans une variable */
    $page = ob_get_contents();//Le contenu capturé (la vue) est stocké dans la variable $page à l'aide de ob_get_contents().
    /* j'efface le tampon */
    ob_end_clean();//ob_end_clean() vide le tampon sans l'afficher, préparant ainsi pour l'affichage du layout.
    /* j'affiche le template principal (layout) */
    include VIEW_DIR."layout.php";//qui contient la structure globale de la page (cf $page dans le layout).
}

/*En résumé, ce fichier gère le routage des requêtes HTTP vers les contrôleurs, 
appelle les méthodes des contrôleurs, charge les vues et affiche le contenu final 
de la page à l'utilisateur.*/