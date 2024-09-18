
//MISE EN PLACE D UN CAROUSEL D IMAGES DANS LA VUE DETAILSANNONCE
let currentSlide = 0; // Variable pour suivre la diapositive actuellement affichée

// Fonction pour changer la diapositive selon la direction (1 pour suivant, -1 pour précédent)
function changeSlide(direction) {
    const slides = document.querySelectorAll('.image-slide'); // Sélectionne toutes les diapositives
    const totalSlides = slides.length; // Nombre total de diapositives

    // Cacher la diapositive actuelle
    slides[currentSlide].style.display = 'none';

    // Calculer la nouvelle diapositive
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides; // Met à jour l'indice de la diapositive actuelle

    // Afficher la nouvelle diapositive
    slides[currentSlide].style.display = 'block'; // Met à jour l'affichage de la nouvelle diapositive
}

// Code pour changer automatiquement les diapositives en survolant
const carousel = document.querySelector('.carousel'); // Sélectionne l'élément carrousel
carousel.addEventListener('mouseenter', () => {
    clearInterval(slideInterval); // Arrête le changement automatique de diapositives au survol
});
carousel.addEventListener('mouseleave', () => {
    startSlideShow(); // Redémarre le diaporama automatique lorsque le curseur sort du carrousel
});

// Fonction pour démarrer le diaporama
let slideInterval; // Variable pour stocker l'intervalle de changement de diapositives
function startSlideShow() {
    // Démarre un intervalle pour changer la diapositive automatiquement
    slideInterval = setInterval(() => {
        changeSlide(1); // Change à la diapositive suivante toutes les 3 secondes
    }, 3000); // Temps d'affichage d'une diapositive (3000ms = 3 secondes)
}

// Démarrer le diaporama automatique au chargement de la page
startSlideShow();
