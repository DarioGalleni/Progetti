// Scorrimento fluido per i link di ancoraggio
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

//anno corrente
document.getElementById('anno-corrente').textContent = new Date().getFullYear();