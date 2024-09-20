<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cormorant:ital,wght@0,300..700;1,300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">        
<link rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
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



        <title>Chez Mon Chat</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header>
                    <nav>
                    <div id="nav-left" class="full-width">
                    <a href="index.php?ctrl=home&action=view">
                <img src="public\img\Logo_gold-removebg-preview.png" alt="Logo">
            </a>
                    <div id="nav-right">
                        <?php
                        // Si l'utilisateur est connecté
                        if(App\Session::getUtilisateur()) {
                            // Vérifiez si l'utilisateur est un administrateur
                            if(App\Session::isAdmin()) {
                                // Navbar pour les administrateurs
                                ?>
                                <ul class="nav-list">
                                    <li><a href="index.php?ctrl=home&action=view">Accueil</a></li>
                                    <li><a href="index.php?ctrl=security&action=monCompte"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUtilisateur() ?></a></li>
                                    <li><a href="index.php?ctrl=location&action=index">Liste des annonces</a></li>
                                    <li><a href="index.php?ctrl=location&action=ajoutAnnonces">Déposer une annonce</a></li>
                                    <li><a href="index.php?ctrl=admin&action=listUtilisateurs">Utilisateurs</a></li>
                                    <li><a href="index.php?ctrl=admin&action=AllAnnonces">Annonces</a></li>
                                    <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                </ul>
                                <?php
                            } else {
                                // Navbar pour les utilisateurs normaux
                                ?>
                                <ul class="nav-list">
                                    <li><a href="index.php?ctrl=home&action=view">Accueil</a></li>
                                    <li><a href="index.php?ctrl=security&action=monCompte"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUtilisateur() ?></a></li>
                                    <li><a href="index.php?ctrl=location&action=index">Liste des annonces</a></li>
                                    <li><a href="index.php?ctrl=location&action=ajoutAnnonces">Déposer une annonce</a></li>
                                    <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                </ul>
                                <?php
                            }
                        } else {
                            ?>
                            <ul class="nav-list">
                                <li><a href="index.php?ctrl=security&action=login">Connexion</a></li>
                                <li><a href="index.php?ctrl=security&action=register">Inscription</a></li>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </nav>
            </header>
                
                <main id="forum">
                    <?= $page ?>
                </main>
            </div>
            <footer class="footer">
    <div class="footer-content">
        <div class="newsletter">
            <h4>Inscrivez-vous à notre newsletter</h4>
            <form action="#" method="POST">
                <input type="email" placeholder="Votre email" required>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
        <div class="social-media">
            <h4>Suivez-nous</h4>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="footer-links">
        <p>&copy; <?= date_create("now")->format("Y") ?> - 
            <a href="index.php?ctrl=location&action=reglement">Règlement de notre site</a> - 
            <a href="index.php?ctrl=location&action=mentionsLegales">Mentions légales</a> - 
            <a href="index.php?ctrl=location&action=FAQ">FAQ</a> - 
            <a href="index.php?ctrl=location&action=contact">Nous contacter</a>
        </p>
    </div>
</footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
               <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>