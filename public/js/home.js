// Fonction pour changer l'image de fond en fonction de la taille de l'écran
function changerImageFondSelonTailleEcran() {
    // Vérifiez la largeur de l'écran
    const largeurEcran = window.innerWidth;

    // Sélectionnez l'élément avec l'image de fond
    const elementAvecImage = document.querySelector("#hero-banner");

    // Si la largeur de l'écran est inférieure ou égale à 475px, changez l'image de fond
    if (largeurEcran <= 600) {
        elementAvecImage.style.backgroundImage = "url('../../img/home/image-home-mobile.png')";
    } else {
        // Si la largeur de l'écran est supérieure à 475px, utilisez l'image de fond normale
        elementAvecImage.style.backgroundImage = "url('../../img/home/image-home.png')";
    }
}

// Appelez la fonction pour initialiser l'image de fond en fonction de la taille de l'écran
changerImageFondSelonTailleEcran();

//écouteur d'événements pour détecter les changements de taille de l'écran
window.addEventListener("resize", changerImageFondSelonTailleEcran);