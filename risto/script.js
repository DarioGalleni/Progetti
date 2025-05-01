// Effetto scroll sulla navbar
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    navbar.classList.toggle('scrolled', window.scrollY > 50);
});

// Scorrimento fluido per i link ancora
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 70,
                behavior: 'smooth'
            });
        }
    });
});

// Gestione invio modulo contatti
const form = document.getElementById('contactForm');
if (form) {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        const name = formData.get('name')?.trim();
        const email = formData.get('email')?.trim();
        const message = formData.get('message')?.trim();
        const privacyAccepted = document.getElementById('privacy')?.checked;

        if (!name || !email || !message) {
            alert('Per favore compila tutti i campi obbligatori.');
            return;
        }

        if (!privacyAccepted) {
            alert('Devi accettare la privacy policy per procedere.');
            return;
        }

        alert('Grazie per il tuo messaggio! Ti risponderemo al più presto.');
        this.reset();

        // Invio con fetch (decommentare e configurare se necessario)
        /*
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                alert('Grazie per il tuo messaggio! Ti risponderemo al più presto.');
                this.reset();
            } else {
                throw new Error('Errore nell\'invio del messaggio');
            }
        })
        .catch(error => {
            alert('Si è verificato un errore. Per favore riprova più tardi.');
            console.error(error);
        });
        */
    });
}
