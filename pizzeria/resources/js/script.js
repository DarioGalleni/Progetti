window.addEventListener("scroll", function() {
    let scrollPos = window.scrollY;
    let navbar = document.querySelector('.navbar');
    let imageContainer = document.querySelector('.image-container');
    let listItems = document.querySelectorAll(".navbar-nav .nav-item"); // Seleziona tutti i li
  
    if (scrollPos > 50) {
      document.body.classList.add("scrolled");
      imageContainer.classList.add("shrink-image");
      navbar.style.backgroundColor = '#F5F5F5';

      // Aggiungi la classe ul_color a tutti i li
      listItems.forEach(function(item) {
        item.classList.add("nav-link");
      });
    } else {
      document.body.classList.remove("scrolled");
      imageContainer.classList.remove("shrink-image");
      navbar.style.backgroundColor = '#D32F2F';


      // Rimuovi la classe ul_color da tutti i li
      listItems.forEach(function(item) {
        item.classList.remove("nav-link");
      });
    }
});

