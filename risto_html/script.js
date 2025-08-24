// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

window.addEventListener('scroll', function () {
    var navbar = document.getElementsByClassName('navbar')[0];
    if (!navbar) return;

    if (window.scrollY > 0) {
        navbar.classList.remove('d-none');
    } else {
        navbar.classList.add('d-none');
    }
});