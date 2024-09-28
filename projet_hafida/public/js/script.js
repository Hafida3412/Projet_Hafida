
//MISE EN PLACE D UN CAROUSEL D IMAGES DANS LA VUE DETAILSANNONCE

let currentSlide = 0;
const slides = document.querySelectorAll('.image-slide');

function changeSlide(direction) {
    // Retire la classe zoom de l'image actuelle
    slides[currentSlide].querySelector('.carousel-image').classList.remove('zoom');

    // Calcule l'index du slide suivant
    currentSlide += direction;

    // Remet le slide à 0 si on dépasse le nombre total, ou à la fin si on tombe en dessous de 0
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }

    // Affiche le slide actuel
    slides.forEach((slide, index) => {
        slide.style.display = (index === currentSlide) ? 'block' : 'none';
    });

    // Ajoute la classe zoom à l'image actuelle
    slides[currentSlide].querySelector('.carousel-image').classList.add('zoom');
}

// Ajoutez un événement pour que la classe zoom soit ajoutée à l'image de départ
document.addEventListener('DOMContentLoaded', function () {
    slides[currentSlide].querySelector('.carousel-image').classList.add('zoom');
});
