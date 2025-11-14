document.addEventListener('DOMContentLoaded', function () {
    /* ==========================
       Modulo: Calendario drag & helpers
       ========================== */
    function initCalendarDragModule() {
        const DRAG_THRESHOLD = 4;
        let isPointerDown = false;
        let isDragging = false;
        let startX = 0, startY = 0;
        let scrollLeft = 0, scrollTop = 0;
        let activeContainer = null; // Riferimento al container attualmente trascinato

        // Funzione per centrare la cella 'oggi' in un contenitore specifico
        function centerToday(calendarContainer) {
            // L'ID 'today' è applicato solo all'intestazione della prima riga (Fila A) in welcome.blade.php
            const todayCell = calendarContainer.querySelector('table #today');
            
            if (todayCell && calendarContainer) {
                const containerRect = calendarContainer.getBoundingClientRect();
                const cellRect = todayCell.getBoundingClientRect();
                const cellOffsetLeft = todayCell.offsetLeft;
                
                // Calcola lo scroll per centrare la cella 'oggi' orizzontalmente
                const scrollTarget = cellOffsetLeft - (containerRect.width / 2) + (cellRect.width / 2);
                calendarContainer.scrollLeft = scrollTarget;
            }
        }
        
        // Funzione per applicare il drag and scroll ad un contenitore
        function setupDragScroll(container) {
            // Avvia trascinamento
            container.addEventListener('mousedown', (e) => {
                if (e.button !== 0) return; // Solo tasto sinistro
                activeContainer = container; // Imposta il contenitore attivo
                isPointerDown = true;
                isDragging = false;
                startX = e.pageX;
                startY = e.pageY;
                scrollLeft = container.scrollLeft;
                scrollTop = container.scrollTop;
            });

            // Previene click durante il drag
            container.addEventListener('click', (e) => {
                if (isDragging) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        }
        
        // Termina trascinamento (globale, rimuove lo stato di drag su tutti)
        window.addEventListener('mouseup', (e) => {
            if (e.button !== 0 || !isPointerDown) return;
            isPointerDown = false;
            activeContainer?.classList.remove('dragging');
            activeContainer = null; // Resetta il contenitore attivo
            setTimeout(() => { isDragging = false; }, 0);
        });

        // Muovi (globale, usa il contenitore attivo)
        window.addEventListener('mousemove', (e) => {
            if (!isPointerDown || !activeContainer) return;
            
            const dx = e.pageX - startX;
            const dy = e.pageY - startY;
            
            if (!isDragging && Math.hypot(dx, dy) > DRAG_THRESHOLD) {
                isDragging = true;
                activeContainer.classList.add('dragging');
            }
            if (isDragging) {
                e.preventDefault();
                activeContainer.scrollLeft = scrollLeft - dx;
                activeContainer.scrollTop = scrollTop - dy;
            }
        });


        // Aggiungi listener per Accordion di Bootstrap (gestisce l'apertura e la centratura)
        const accordion = document.getElementById('calendarAccordion');
        if (accordion) {
            // Listener per quando un accordion si apre (e finisce l'animazione)
            accordion.addEventListener('shown.bs.collapse', function (event) {
                const collapseBody = event.target;
                const calendarContainer = collapseBody.querySelector('.drag-scroll');
                
                if (calendarContainer) {
                    // 1. Applica la logica di drag and scroll
                    setupDragScroll(calendarContainer);
                    // 2. Centra la data odierna
                    centerToday(calendarContainer);
                }
            });
            
            // Setup iniziale e centratura per i contenitori inizialmente visibili (la prima fila)
            document.querySelectorAll('#calendarAccordion .accordion-collapse.show .drag-scroll').forEach(container => {
                setupDragScroll(container);
                // Centra 'oggi' solo dopo che l'elemento è visibile e pronto
                centerToday(container);
                // Riprova a centrare 'oggi' al resize della finestra
                window.addEventListener('resize', () => centerToday(container));
            });
        }
        
    }

    /* ==========================
       Inizializzazione moduli
       ========================== */
    // initThemeModule(); <-- RIMOSSA
    initCalendarDragModule();
});