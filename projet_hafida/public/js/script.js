//MISE EN PLACE D UN CAROUSEL D IMAGES DANS LA VUE DETAILSANNONCE

// Initialisation de l'index du slide actuel à 0
let currentSlide = 0;

// Sélectionne tous les éléments avec la classe '.image-slide' pour les slides du carousel
const slides = document.querySelectorAll('.image-slide');

// Fonction qui change le slide en fonction de la direction (1 pour suivant, -1 pour précédent)
function changeSlide(direction) {
    // Retire la classe zoom de l'image actuelle
    slides[currentSlide].querySelector('.carousel-image').classList.remove('zoom');

    // Calcule l'index du slide suivant en ajoutant la direction
    currentSlide += direction;

    // Vérifie si l'index dépasse le nombre total de slides
    // Si oui, on revient au premier slide
    if (currentSlide >= slides.length) {
        currentSlide = 0;

    // Vérifie si l'index est inférieur à 0
    // Si oui, on passe au dernier slide
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }

    // Affiche le slide actuel et cache les autres
    slides.forEach((slide, index) => {
        // Si l'index du slide est égal à currentSlide, on l'affiche
        slide.style.display = (index === currentSlide) ? 'block' : 'none';
    });

    // Ajoute la classe 'zoom' à l'image actuelle pour l'effet de zoom
    slides[currentSlide].querySelector('.carousel-image').classList.add('zoom');
}

// Lorsque le document est complètement chargé
document.addEventListener('DOMContentLoaded', function () {
    // On ajoute la classe 'zoom' à l'image de départ pour afficher l'effet de zoom
    slides[currentSlide].querySelector('.carousel-image').classList.add('zoom');
});
