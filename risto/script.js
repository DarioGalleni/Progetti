// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        var navbar = document.getElementsByClassName('navbar')[0];
        if (navbar) {
            navbar.classList.add('d-none');
        }
    }
});

console.log("Script loaded successfully!");
