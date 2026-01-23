/**
 * ==========================================
 * 1. ANIMAZIONI SCROLL (Reveal & Parallax)
 * ==========================================
 */

/**
 * Gestisce l'animazione di comparsa degli elementi allo scroll (classe .reveal)
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

                // Avvia il contatore solo se siamo nella sezione statistiche e non è già partito
                if (reveal.classList.contains('stats-container') && !reveal.hasAttribute('data-counted')) {
                    startCounter();
                    reveal.setAttribute('data-counted', 'true');
                }
            }
        }
    });
}

/**
 * Gestisce l'effetto Parallax sugli elementi (classe .parallax-scroll)
 * Calcola la traslazione verticale basandosi sulla posizione rispetto al centro dello schermo.
 */
function handleParallax() {
    const parallaxElements = document.querySelectorAll('.parallax-scroll');

    parallaxElements.forEach(element => {
        const rect = element.getBoundingClientRect();
        // Controlla se l'elemento è visibile nel viewport
        const isInView = (rect.top <= window.innerHeight) && (rect.bottom >= 0);

        if (isInView) {
            const speed = parseFloat(element.getAttribute('data-parallax-speed') || 0.5);

            // Calcola la distanza dal centro dello schermo
            const centerPosition = window.innerHeight / 2;
            const elementCenter = rect.top + (rect.height / 2);
            const distanceFromCenter = centerPosition - elementCenter;

            // Applica la traslazione Y
            const translateY = distanceFromCenter * speed;
            element.style.transform = `translateY(${translateY}px)`;
        }
    });
}

/**
 * ==========================================
 * 2. COMPONENTI UI INTERATTIVI
 * ==========================================
 */

/**
 * Animazione contatore per la sezione statistiche
 */
function startCounter() {
    const counters = document.querySelectorAll('.counter-value');
    const duration = 2000;

    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const suffix = counter.getAttribute('data-suffix') || '';
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            const current = Math.floor(progress * target);
            counter.innerText = current.toLocaleString('it-IT');

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                counter.innerText = target.toLocaleString('it-IT') + suffix;
            }
        };

        window.requestAnimationFrame(step);
    });
}

/**
 * ==========================================
 * 3. LOGICA FORM DINAMICI (Viaggi Create/Edit)
 * ==========================================
 */

/**
 * Aggiunge un campo dinamico (es. Include/Esclude)
 */
function addItem(containerId, inputName) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control bg-dark text-white border-secondary rounded-0 p-2" name="${inputName}" placeholder="Nuova voce">
        <button type="button" class="btn btn-outline-secondary rounded-0" onclick="removeItem(this)">
            <i class="bi bi-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

/**
 * Rimuove un elemento dinamico generico
 */
function removeItem(button) {
    button.closest('.input-group').remove();
}

/**
 * Aggiunge un giorno all'itinerario
 */
function addDay() {
    const container = document.getElementById('itinerary-container');
    if (!container) return;

    const days = container.children.length;
    const newIndex = days;

    const card = document.createElement('div');
    card.className = 'card bg-dark border-secondary mb-3 itinerary-day';
    card.innerHTML = `
        <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center">
            <span class="text-white small text-uppercase fw-bold">Giorno <span class="day-number">${days + 1}</span></span>
            <button type="button" class="btn btn-sm text-secondary hover-text-danger p-0" onclick="removeDay(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <input type="text" class="form-control bg-black text-white border-secondary rounded-0 mb-2" 
                    name="itinerary[${newIndex}][title]" placeholder="Titolo del giorno" required>
            </div>
            <div>
                <textarea class="form-control bg-black text-white border-secondary rounded-0" 
                    name="itinerary[${newIndex}][description]" rows="3" placeholder="Descrizione delle attività..." required></textarea>
            </div>
        </div>
    `;
    container.appendChild(card);
    updateDayNumbers();
}

/**
 * Rimuove un giorno dall'itinerario e ricalcola gli indici
 */
function removeDay(button) {
    const card = button.closest('.itinerary-day');
    card.remove();
    updateDayNumbers();
    reindexItinerary();
}

function updateDayNumbers() {
    const days = document.querySelectorAll('.itinerary-day');
    days.forEach((day, index) => {
        day.querySelector('.day-number').innerText = index + 1;
    });
}

function reindexItinerary() {
    const days = document.querySelectorAll('.itinerary-day');
    days.forEach((day, index) => {
        const inputs = day.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            if (input.name.includes('[title]')) input.name = `itinerary[${index}][title]`;
            if (input.name.includes('[description]')) input.name = `itinerary[${index}][description]`;
        });
    });
}

/**
 * Anteprima Immagini Upload
 */
function initImagePreview() {
    const imageInput = document.getElementById('images');
    if (!imageInput) return;

    imageInput.addEventListener('change', function (event) {
        const container = document.getElementById('imagePreviewContainer');
        const coverInput = document.getElementById('coverImageIndex');

        if (!container || !coverInput) return;

        container.innerHTML = '';
        const files = event.target.files;
        if (files.length === 0) return;

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.className = 'col-6';

                const card = document.createElement('div');
                card.className = 'card bg-dark border-secondary h-100 overflow-hidden';

                const imgContainer = document.createElement('div');
                Object.assign(imgContainer.style, {
                    height: '100px',
                    backgroundImage: `url(${e.target.result})`,
                    backgroundSize: 'contain',
                    backgroundRepeat: 'no-repeat',
                    backgroundPosition: 'center',
                });
                imgContainer.className = 'bg-black';

                const cardBody = document.createElement('div');
                cardBody.className = 'card-body p-2 text-center';

                const formCheck = document.createElement('div');
                formCheck.className = 'form-check d-flex justify-content-center align-items-center m-0';

                const radio = document.createElement('input');
                radio.className = 'form-check-input border-secondary bg-dark';
                radio.type = 'radio';
                radio.name = 'cover_selection';
                radio.id = `cover_${index}`;
                radio.checked = (index === 0);

                radio.addEventListener('change', function () {
                    if (this.checked) coverInput.value = index;
                });

                const label = document.createElement('label');
                label.className = 'form-check-label text-secondary small ms-2';
                label.htmlFor = `cover_${index}`;
                label.innerText = 'Cover';
                label.style.cursor = 'pointer';

                formCheck.append(radio, label);
                cardBody.appendChild(formCheck);
                card.append(imgContainer, cardBody);
                col.appendChild(card);
                container.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    });
}

/**
 * ==========================================
 * 4. INIZIALIZZAZIONE EVENTI & SCROLL
 * ==========================================
 */

/**
 * Gestisce il cambio stile della Navbar allo scroll
 */
function handleNavbarScroll() {
    const nav = document.getElementById('mainNav');
    if (!nav) return;

    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
}

// Evento Scroll ottimizzato con requestAnimationFrame
let isScrolling = false;
window.addEventListener('scroll', function () {
    if (!isScrolling) {
        window.requestAnimationFrame(function () {
            handleNavbarScroll();
            handleReveal();
            handleParallax();
            isScrolling = false;
        });
        isScrolling = true;
    }
});

/**
 * Rimuove automaticamente gli alert di successo dopo 5 secondi
 */
function initAlertDismissal() {
    setTimeout(function () {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }
    }, 5000);
}

// Inizializzazione al caricamento del DOM
document.addEventListener('DOMContentLoaded', function () {
    handleReveal();
    handleParallax();
    initImagePreview();
    initAlertDismissal();
});

// Espone le funzioni globalmente per gli onclick nel HTML
window.addItem = addItem;
window.removeItem = removeItem;
window.addDay = addDay;
window.removeDay = removeDay;
