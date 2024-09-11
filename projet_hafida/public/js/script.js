// Fonction pour accepter les cookies
function acceptCookies() {
    localStorage.setItem('cookiesAccepted', 'true');
    document.getElementById('cookie-popup').style.display = 'none';
}

// Fonction pour refuser les cookies
function refuseCookies() {
    localStorage.setItem('cookiesAccepted', 'false');
    document.getElementById('cookie-popup').style.display = 'none';
}

// Vérifier si l'utilisateur a déjà fait un choix concernant les cookies
window.onload = function() {
    const cookiesAccepted = localStorage.getItem('cookiesAccepted');
    if (cookiesAccepted === null) {
        // Afficher le popup s'il n'y a pas de choix enregistré
        document.getElementById('cookie-popup').style.display = 'block';
    }
    // Si l'utilisateur a déjà accepté ou refusé, ne rien faire
};


let currentSlide = 0;

function changeSlide(direction) {
    const slides = document.querySelectorAll('.image-slide');
    const totalSlides = slides.length;

    // Cacher la diapositive actuelle
    slides[currentSlide].style.display = 'none';

    // Calculer la nouvelle diapositive
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;

    // Afficher la nouvelle diapositive
    slides[currentSlide].style.display = 'block';
}

// Code pour changer automatiquement les diapositives en survolant
const carousel = document.querySelector('.carousel');
carousel.addEventListener('mouseenter', () => {
    clearInterval(slideInterval);
});
carousel.addEventListener('mouseleave', () => {
    startSlideShow();
});

// Fonction pour démarrer le diaporama
let slideInterval; 
function startSlideShow() {
    slideInterval = setInterval(() => {
        changeSlide(1);
    }, 3000); // changement toutes les 3 secondes
}

// Démarrer le diaporama automatique
startSlideShow();
