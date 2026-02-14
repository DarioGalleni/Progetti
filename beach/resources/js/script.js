import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    /* ==========================================================================
       SEZIONE 1: Modulo Drag & Scroll
       Descrizione: Gestisce il trascinamento orizzontale (drag-to-scroll)
       delle tabelle del calendario.
       ========================================================================== */
    function initCalendarDragModule() {
        const DRAG_THRESHOLD = 4;
        let isPointerDown = false;
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;
        let activeContainer = null;

        /**
         * Centra la vista del contenitore sulla colonna della data odierna "Oggi".
         * Usa animazione smooth.
         */
        function centerToday(calendarContainer) {
            const todayCell = calendarContainer.querySelector('table .js-today-header');
            if (todayCell && calendarContainer) {
                const containerRect = calendarContainer.getBoundingClientRect();
                const cellRect = todayCell.getBoundingClientRect();
                // Calcola offset per centrare
                const cellOffsetLeft = todayCell.offsetLeft;
                const scrollTarget = cellOffsetLeft - (containerRect.width / 2) + (cellRect.width / 2);

                calendarContainer.scrollTo({
                    left: scrollTarget,
                    behavior: 'smooth'
                });
            }
        }

        /**
         * Imposta i listener per gli eventi puntatore (mouse/touch)
         * per abilitare il drag.
         */
        function setupDragScroll(container) {
            const events = ['pointerdown', 'pointerup', 'pointerleave', 'pointermove'];

            // Cleanup preventivo
            events.forEach(evt => container.removeEventListener(evt, handleEvent));

            // Setup
            container.addEventListener('pointerdown', handlePointerDown);
            container.addEventListener('pointerup', handlePointerUp);
            container.addEventListener('pointerleave', handlePointerUp);
            container.addEventListener('pointermove', handlePointerMove);
        }

        // Helper per rimuovere listener (usato sopra logicamente, ma qui separato per chiarezza se necessario)
        function handleEvent(e) { /* Placeholder per logica unificata se servisse */ }

        function handlePointerDown(e) {
            if (e.button !== 0) return; // Solo tasto sx
            isPointerDown = true;
            isDragging = false;
            activeContainer = e.currentTarget;
            startX = e.pageX - activeContainer.offsetLeft;
            scrollLeft = activeContainer.scrollLeft;
            activeContainer.classList.add('dragging');
        }

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

        function handlePointerMove(e) {
            if (!isPointerDown) return;
            e.preventDefault();
            const dx = e.pageX - activeContainer.offsetLeft - startX;

            if (Math.abs(dx) > DRAG_THRESHOLD) {
                isDragging = true;
            }

            if (isDragging) {
                activeContainer.scrollLeft = scrollLeft - dx;
            }
        }

        function preventDragOnLinks(container) {
            // Evita che cliccare su link o bottoni attivi il drag
            container.querySelectorAll('a, button, .prevent-drag').forEach(el => {
                el.addEventListener('pointerdown', (e) => e.stopPropagation());
            });
        }

        /* ----------------------------------------------------------------------
           Inizializzazione Listener su Accordion
           ---------------------------------------------------------------------- */
        const accordion = document.getElementById('calendarAccordionDesktop');

        if (accordion) {
            // All'apertura di una fila (Accordion Item)
            accordion.addEventListener('shown.bs.collapse', function (event) {
                const collapseBody = event.target;
                const calendarContainer = collapseBody.querySelector('.drag-scroll');

                if (calendarContainer) {
                    setupDragScroll(calendarContainer);
                    preventDragOnLinks(calendarContainer);
                    // Piccolo ritardo per rendering
                    setTimeout(() => centerToday(calendarContainer), 50);
                }
            });

            // Per le file già aperte al caricamento
            document.querySelectorAll('#calendarAccordionDesktop .accordion-collapse.show .drag-scroll').forEach(container => {
                setupDragScroll(container);
                preventDragOnLinks(container);
                setTimeout(() => centerToday(container), 100);

                // Ricentra al resize finestra
                window.addEventListener('resize', () => centerToday(container));
            });
        }

        /* ----------------------------------------------------------------------
           Inizializzazione Tooltip Bootstrap
           ---------------------------------------------------------------------- */
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Avvio Modulo Calendario
    initCalendarDragModule();


    /* ==========================================================================
       SEZIONE 2: UI Utilities & Helpers
       Descrizione: Funzioni accessorie per UX (Saluti, Formattazione, ecc.)
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
