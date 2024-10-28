<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Meta tag pour Responsive design (essentiel pour la réactivité) -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <!-- Description du site pour le SEO -->
        <meta name="description" content=" <?=$meta?>" />
        <title><?= $title?></title><!-- Titre de la page affiché dans l'onglet du navigateur -->
        
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Préconnections pour améliorer la performance du chargement des polices -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
        
         <!-- Liens pour les polices Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cormorant:ital,wght@0,300..700;1,300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">        
       
         <!-- Liens vers les bibliothèques Font Awesome pour les icônes -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        
        <!-- Liens vers les feuilles de style des différentes vues du site -->
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/home.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/login.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/register.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/listAnnonces.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/detailsAnnonce.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/ajoutAnnonces.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/detailsUtilisateur.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/reservation.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/confirmation.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/listeLogementsUtilisateur.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/listUtilisateurs.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/allAnnonces.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/faq.css">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/responsive.css">

        
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                 <!-- Section pour afficher les messages d'erreur ou de succès à l'utilisateur -->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header>
                    <nav>
                    <div id="nav-left" class="full-width">
                    <a href="index.php?ctrl=home&action=view">
                <!-- Logo du site -->
                <img src="public\img\Logo_gold-removebg-preview (1).webp" alt="Logo">
            </a>
            </div>
            <div id="nav-right">
            <div id="menu-toggle" class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
                            <ul class="nav-list">
                                <?php
                                // Vérification si l'utilisateur est connecté
                                if (App\Session::getUtilisateur()) {
                                    // Vérifiez si l'utilisateur est un administrateur
                                    if (App\Session::isAdmin()) {
                                        ?>
                                        <li><a href="index.php?ctrl=home&action=view">Accueil</a></li>
                                        <li><a href="index.php?ctrl=location&action=index">Liste des annonces</a></li>
                                        <li><a href="index.php?ctrl=location&action=ajoutAnnonces">Déposer une annonce</a></li>
                                        <li><a href="index.php?ctrl=admin&action=listUtilisateurs">Utilisateurs</a></li>
                                        <li><a href="index.php?ctrl=admin&action=AllAnnonces">Annonces</a></li>
                                        <li><a href="index.php?ctrl=security&action=monCompte"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUtilisateur() ?></a></li>
                                        <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                        <?php
                                    } else {
                                        ?>
                                        <li><a href="index.php?ctrl=home&action=view">Accueil</a></li>
                                        <li><a href="index.php?ctrl=location&action=index">Liste des annonces</a></li>
                                        <li><a href="index.php?ctrl=location&action=ajoutAnnonces">Déposer une annonce</a></li>
                                        <li><a href="index.php?ctrl=security&action=monCompte"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUtilisateur() ?></a></li>
                                        <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                        <?php
                                    }
                                } else {
                                     // Affichage des liens de connexion et d'inscription si l'utilisateur n'est pas connecté
                                    ?><div class="nav-right-connect">
                                    <li><a href="index.php?ctrl=security&action=login">Connexion</a></li>
                                    <li><a href="index.php?ctrl=security&action=register">Inscription</a></li>
                                </div>   <?php
                                }
                                ?>
                            </ul>
                        </div>
                </nav>
            </header>
                
                <main id="forum">
                    <?= $page ?> <!-- Contenu principal du site -->
                </main>
            </div>
            <footer class="footer">
    <div class="footer-content">
        <div class="newsletter">
            <h4>Inscrivez-vous à notre newsletter</h4>
            <form action="#" method="POST">
                <input type="email" placeholder="Votre email" required>
                <button type="submit" class="button-button">S'inscrire</button>
            </form>
        </div>
        <div class="social-media">
            <h4>Suivez-nous!</h4>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="footer-links">
        <p>&copy; <?= date_create("now")->format("Y") ?> - 
            <a href="index.php?ctrl=location&action=reglement">Règlement de notre site</a> - 
            <a href="index.php?ctrl=location&action=politiqueConfidentialite">Politique de Confidentialité</a> - 
            <a href="index.php?ctrl=location&action=FAQ">FAQ</a> - 
            <a href="index.php?ctrl=location&action=contact">Nous contacter</a>
        </p>
    </div>
</footer>
        </div>
        <!-- Inclusion de la bibliothèque jQuery version 3.4.1 depuis le CDN de jQuery :
         -- URL de la bibliothèque jQuery 
         -- Hash pour la vérification de l'intégrité du fichier
         -- Indique que les requêtes cross-origin sont autorisées -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" 
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                // Lorsque le document est prêt, commence l'exécution du code à l'intérieur

                // Animation pour afficher et masquer les messages/
                // Sélectionne chaque élément avec la classe "message"
                $(".message").each(function(){
                    // Vérifie si le texte de l'élément n'est pas vide
                    if($(this).text().length > 0){
                        // Si le texte existe, anime l'élément avec un effet de "glissement" vers le bas
                        $(this).slideDown(500, function(){
                            // Après que l'élément soit complètement visible, attend 3000 ms (3 secondes)
                            $(this).delay(3000).slideUp(500)/// Puis anime l'élément avec un effet de "glissement" vers le haut
                        })
                    }
                })
                // Confirmation avant suppression
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                 // Configuration pour initialiser l'éditeur de texte TinyMCE sur une page web
                tinymce.init({//pour initialiser TinyMCE avec des options spécifiées dans un objet JavaScript.
                    selector: '.post',//tous les éléments avec la classe post seront transformés en éditeurs
                    menubar: false,//Cette option désactive la barre de menu en haut de l'éditeur.
                    plugins: [/*Cette section définit les plugins supplémentaires qui seront activés 
                    dans l'éditeur. Les plugins cités permettent d'ajouter des fonctionnalités comme la gestion 
                    des listes, l'insertion d'images, la recherche et le remplacement de texte, etc.*/
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: /*Cette option spécifie les boutons qui apparaîtront sur la barre d'outils de l’éditeur. 
                    Les boutons incluent les options pour annuler/rétablir des actions, le formatage du texte, 
                    l'alignement, les listes, etc. */
                    'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css:/*Cette option permet de chargé une feuille de style CSS externe pour styliser le contenu 
                    à l'intérieur de l'éditeur. Cela peut aider à rendre l’apparence du contenu saisie similaire à sa 
                    présentation finale. */ 
                    '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
               <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>