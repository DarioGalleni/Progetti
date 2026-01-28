import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    /* ==========================================================================
       SEZIONE 1: Gestione Drag & Scroll (Trascinamento Calendario)
       Descrizione: Gestisce la logica per trascinare la tabella orizzontalmente
       usando il mouse, simile a Google Maps.
       ========================================================================== */
    function initCalendarDragModule() {
        const DRAG_THRESHOLD = 4;
        let isPointerDown = false;
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;
        let activeContainer = null;

        // Centra la vista sulla data odierna
        function centerToday(calendarContainer) {
            const todayCell = calendarContainer.querySelector('table #today');
            if (todayCell && calendarContainer) {
                const containerRect = calendarContainer.getBoundingClientRect();
                const cellRect = todayCell.getBoundingClientRect();
                const cellOffsetLeft = todayCell.offsetLeft;
                const scrollTarget = cellOffsetLeft - (containerRect.width / 2) + (cellRect.width / 2);
                calendarContainer.scrollLeft = scrollTarget;
            }
        }

        // Configura i listener per gli eventi del mouse
        function setupDragScroll(container) {
            // Rimuove eventuali listener precedenti per evitare duplicati
            container.removeEventListener('pointerdown', handlePointerDown);
            container.removeEventListener('pointerup', handlePointerUp);
            container.removeEventListener('pointerleave', handlePointerUp);
            container.removeEventListener('pointermove', handlePointerMove);

            // Aggiunge i nuovi listener
            container.addEventListener('pointerdown', handlePointerDown);
            container.addEventListener('pointerup', handlePointerUp);
            container.addEventListener('pointerleave', handlePointerUp);
            container.addEventListener('pointermove', handlePointerMove);
        }

        // Inizio del trascinamento
        function handlePointerDown(e) {
            if (e.button !== 0) return; // Solo tasto sinistro
            isPointerDown = true;
            isDragging = false;
            activeContainer = e.currentTarget;
            startX = e.pageX - activeContainer.offsetLeft;
            scrollLeft = activeContainer.scrollLeft;
            activeContainer.classList.add('dragging');
        }

        // Fine del trascinamento
        function handlePointerUp(e) {
            if (isPointerDown) {
                activeContainer.classList.remove('dragging');
                isPointerDown = false;
                if (isDragging) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            }
            isDragging = false;
            activeContainer = null;
        }

        // Movimento del mouse
        function handlePointerMove(e) {
            if (!isPointerDown) return;
            e.preventDefault();
            const dx = e.pageX - activeContainer.offsetLeft - startX;

            // Inizia a considerare "drag" solo dopo una certa soglia di movimento
            if (Math.abs(dx) > DRAG_THRESHOLD) {
                isDragging = true;
            }

            if (isDragging) {
                activeContainer.scrollLeft = scrollLeft - dx;
            }
        }

        // Evita che il click su link interferisca col drag
        function preventDragOnLinks(container) {
            container.querySelectorAll('a, button, .prevent-drag').forEach(el => {
                el.addEventListener('pointerdown', (e) => e.stopPropagation());
            });
        }

        /* ==========================================================================
           SEZIONE 2: Inizializzazione e Listener
           Descrizione: Attiva la logica di drag sui container corretti all'avvio
           e quando vengono aperti gli accordion.
           ========================================================================== */
        const accordion = document.getElementById('calendarAccordion');

        if (accordion) {
            // Quando si apre una fila, inizializza il drag su quella specifica tabella
            accordion.addEventListener('shown.bs.collapse', function (event) {
                const collapseBody = event.target;
                const calendarContainer = collapseBody.querySelector('.drag-scroll');

                if (calendarContainer) {
                    setupDragScroll(calendarContainer);
                    preventDragOnLinks(calendarContainer);
                    centerToday(calendarContainer);
                }
            });

            // Inizializza le file già aperte al caricamento pagina
            document.querySelectorAll('#calendarAccordion .accordion-collapse.show .drag-scroll').forEach(container => {
                setupDragScroll(container);
                preventDragOnLinks(container);
                centerToday(container);
                window.addEventListener('resize', () => centerToday(container));
            });
        }

        // Attivazione Tooltip di Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Avvia il modulo calendario
    initCalendarDragModule();




    /* ==========================================================================
       SEZIONE 3: Utility Interfaccia Utente
       Descrizione: Funzioni accessorie per migliorare la UX (es. saluto orario).
       ========================================================================== */
    function getSalutoDelGiorno() {
        const ora = new Date().getHours();
        if (ora >= 5 && ora < 13) return "Buongiorno";
        else if (ora >= 13 && ora < 18) return "Buon pomeriggio";
        else return "Buonasera";
    }

    const elementoSaluto = document.getElementById('saluto-dinamico');
    if (elementoSaluto) {
        elementoSaluto.textContent = getSalutoDelGiorno();
    }
});

/* ==========================================================================
   SEZIONE 4: Helper Globali
   Descrizione: Funzioni accessibili da attributi inline HTML (onclick).
   ========================================================================== */

/**
 * Gestisce l'apertura dei link solo se il tasto CTRL (o Command) è premuto.
 * Utile per distinguere tra "trascinamento calendario" e "apertura prenotazione".
 */
window.handleCtrlClick = function (event, url) {
    if (event.ctrlKey || event.metaKey) {
        window.location.href = url;
    } else {
        event.preventDefault();
    }
};