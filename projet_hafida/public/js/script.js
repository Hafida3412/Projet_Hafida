/*Code pour supprimer le cookie-popup*/
function acceptCookies() {
    document.getElementById("cookie-popup").style.display = "none";
  }
  
  function refuseCookies() {
    document.getElementById("cookie-popup").style.display = "none";
  }


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