let nav = document.querySelector(".navbar");
let navLinks = document.querySelectorAll(".nav-link");

window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        nav.classList.add("prova");
        navLinks.forEach(link => {
            link.style.color = "red";
        });
    } else {
        nav.classList.remove("prova");
        navLinks.forEach(link => {
            link.style.color = "initial";
        });
    }
});


