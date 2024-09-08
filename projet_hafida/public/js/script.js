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

  //ANIMATION DES IMAGES UPLOADEES DANS DETAILSANNONCE
  // Index actuel pour l'image affichée
  let currentIndex = 0;
  // Sélectionne tous les éléments <img> dans la classe 'images'
  const images = document.querySelectorAll('.images img');
  // Nombre total d'images
  const totalImages = images.length;


  // Fonction pour afficher l'image correspondant à l'index donné
  function showImage(index) {
      images.forEach((img, i) => {
          img.classList.remove('active'); // masque toutes les images en retirant la classe 'active'
          if (i === index) {
              img.classList.add('active'); // ajoute la classe 'active' uniquement à l'image correspondante à l'index
          }
      });
  }

  // Fonction pour passer à l'image suivante
  function nextImage() {
      currentIndex = (currentIndex + 1) % totalImages; //  // Passe à l'image suivante en réinitialisant à 0 si à la fin
      showImage(currentIndex);// Affiche l'image active mise à jour
  }

  setInterval(nextImage, 3000); // Change d'image toutes les 3 secondes
  showImage(currentIndex); // Affiche la première image au chargement de la page