/**
 * Counter Animation for Stats Section
 */
function startCounter() {
    const counters = document.querySelectorAll('.counter-value');
    const duration = 2000; // Durata dell'animazione in millisecondi (2 secondi)

    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const suffix = counter.getAttribute('data-suffix') || '';
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            // Calcola il valore corrente basato sul progresso
            // Usa Math.floor per numeri interi
            const current = Math.floor(progress * target);

            // Formatta il numero con i punti delle migliaia se necessario (opzionale)
            // Visualizza il numero nudo durante l'animazione, aggiungi suffisso alla fine
            counter.innerText = current.toLocaleString('it-IT');

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                // Assicura che il valore finale sia esatto e aggiungi il suffisso
                counter.innerText = target.toLocaleString('it-IT') + suffix;
            }
        };

        window.requestAnimationFrame(step);
    });
}

/**
 * Scroll Reveal Animation logic
 */
function handleReveal() {
    const reveals = document.querySelectorAll('.reveal');
    const windowHeight = window.innerHeight;
    const revealPoint = 150;

    reveals.forEach(reveal => {
        const revealTop = reveal.getBoundingClientRect().top;

        if (revealTop < windowHeight - revealPoint) {
            if (!reveal.classList.contains('active')) {
                reveal.classList.add('active');

                // Se è la sezione statistiche, avvia il counter una sola volta
                if (reveal.classList.contains('stats-container') && !reveal.hasAttribute('data-counted')) {
                    startCounter();
                    reveal.setAttribute('data-counted', 'true');
                }
            }
        }
    });
}

// Inizializzazione
document.addEventListener('DOMContentLoaded', function () {
    // Controllo iniziale
    handleReveal();

    // Controllo allo scroll
    window.addEventListener('scroll', handleReveal);
});
