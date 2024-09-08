/*Code pour supprimer le cookie-popup*/
function acceptCookies() {
    document.getElementById("cookie-popup").style.display = "none";
  }
  
  function refuseCookies() {
    document.getElementById("cookie-popup").style.display = "none";
  }


  let currentIndex = 0;
  const images = document.querySelectorAll('.images img');
  const totalImages = images.length;

  function showImage(index) {
      images.forEach((img, i) => {
          img.classList.remove('active'); // Masquer toutes les images
          if (i === index) {
              img.classList.add('active'); // Affiche l'image active
          }
      });
  }

  function nextImage() {
      currentIndex = (currentIndex + 1) % totalImages; // passe à l'image suivante
      showImage(currentIndex);
  }

  setInterval(nextImage, 3000); // Change d'image toutes les 3 secondes
  showImage(currentIndex); // Affiche la première image