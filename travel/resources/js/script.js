/**
 * ==========================================
 * 1. ANIMAZIONI SCROLL (Reveal & Parallax)
 * ==========================================
 */

/**
 * Gestisce l'animazione di comparsa elementi (.reveal)
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
                // Avvia contatore statistiche se necessario
                if (reveal.classList.contains('stats-container') && !reveal.hasAttribute('data-counted')) {
                    startCounter();
                    reveal.setAttribute('data-counted', 'true');
                }
            }
        }
    });
}

/**
 * Gestisce effetto Parallax (.parallax-scroll)
 */
function handleParallax() {
    document.querySelectorAll('.parallax-scroll').forEach(element => {
        const rect = element.getBoundingClientRect();
        // Calcola solo se visibile
        if (rect.top <= window.innerHeight && rect.bottom >= 0) {
            const speed = parseFloat(element.getAttribute('data-parallax-speed') || 0.5);
            const distanceFromCenter = (window.innerHeight / 2) - (rect.top + (rect.height / 2));
            element.style.transform = `translateY(${distanceFromCenter * speed}px)`;
        }
    });
}

/**
 * ==========================================
 * 2. COMPONENTI UI INTERATTIVI
 * ==========================================
 */

/**
 * Animazione numeri incrementali
 */
function startCounter() {
    const duration = 2000;
    document.querySelectorAll('.counter-value').forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const suffix = counter.getAttribute('data-suffix') || '';
        let start = null;

        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            counter.innerText = Math.floor(progress * target).toLocaleString('it-IT') + (progress === 1 ? suffix : '');
            if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
    });
}

/**
 * ==========================================
 * 3. LOGICA FORM DINAMICI (Viaggi)
 * ==========================================
 */

/**
 * Aggiunge campo dinamico (Include/Esclude)
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
 * Rimuove elemento dinamico
 */
function removeItem(button) {
    button.closest('.input-group').remove();
}

/**
 * Aggiunge giorno itinerario
 */
function addDay() {
    const container = document.getElementById('itinerary-container');
    if (!container) return;

    const index = container.children.length;
    const card = document.createElement('div');
    card.className = 'card bg-dark border-secondary mb-3 itinerary-day';
    card.innerHTML = `
        <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center">
            <span class="text-white small text-uppercase fw-bold">Giorno <span class="day-number">${index + 1}</span></span>
            <button type="button" class="btn btn-sm text-secondary hover-text-danger p-0" onclick="removeDay(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <input type="text" class="form-control bg-black text-white border-secondary rounded-0 mb-2" 
                    name="itinerary[${index}][title]" placeholder="Titolo del giorno" required>
            </div>
            <div>
                <textarea class="form-control bg-black text-white border-secondary rounded-0" 
                    name="itinerary[${index}][description]" rows="3" placeholder="Descrizione delle attività..." required></textarea>
            </div>
        </div>
    `;
    container.appendChild(card);
}

/**
 * Rimuove giorno e ricalcola indici
 */
function removeDay(button) {
    button.closest('.itinerary-day').remove();
    updateItineraryIndices();
}

function updateItineraryIndices() {
    document.querySelectorAll('.itinerary-day').forEach((day, index) => {
        day.querySelector('.day-number').innerText = index + 1;
        day.querySelectorAll('input, textarea').forEach(input => {
            if (input.name.includes('[title]')) input.name = `itinerary[${index}][title]`;
            if (input.name.includes('[description]')) input.name = `itinerary[${index}][description]`;
        });
    });
}

/**
 * Anteprima immagini upload con selezione cover
 */
function initImagePreview() {
    const imageInput = document.getElementById('images');
    if (!imageInput) return;

    imageInput.addEventListener('change', function (event) {
        const container = document.getElementById('imagePreviewContainer');
        const coverInput = document.getElementById('coverImageIndex');
        if (!container || !coverInput) return;

        container.innerHTML = '';
        if (event.target.files.length === 0) return;

        Array.from(event.target.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.className = 'col-6';
                col.innerHTML = `
                    <div class="card bg-dark border-secondary h-100 overflow-hidden">
                        <div class="bg-black" style="height: 100px; background-image: url(${e.target.result}); background-size: contain; background-repeat: no-repeat; background-position: center;"></div>
                        <div class="card-body p-2 text-center">
                            <div class="form-check d-flex justify-content-center align-items-center m-0">
                                <input class="form-check-input border-secondary bg-dark" type="radio" name="cover_selection" id="cover_${index}" ${index === 0 ? 'checked' : ''}>
                                <label class="form-check-label text-secondary small ms-2" for="cover_${index}" style="cursor: pointer;">Cover</label>
                            </div>
                        </div>
                    </div>
                `;
                col.querySelector('input').addEventListener('change', () => coverInput.value = index);
                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });
}

/**
 * ==========================================
 * 4. GESTIONE EVENTI GLOBALI
 * ==========================================
 */

function handleNavbarScroll() {
    const nav = document.getElementById('mainNav');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
}

// Loop visualizzazione ottimizzato
let isScrolling = false;
window.addEventListener('scroll', () => {
    if (!isScrolling) {
        window.requestAnimationFrame(() => {
            handleNavbarScroll();
            handleReveal();
            handleParallax();
            isScrolling = false;
        });
        isScrolling = true;
    }
});

function initAlertDismissal() {
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    handleReveal();
    handleParallax();
    initImagePreview();
    initAlertDismissal();
});
// Esposizione globale per attributi onclick
window.addItem = addItem;
window.removeItem = removeItem;
window.addDay = addDay;
window.removeDay = removeDay;
