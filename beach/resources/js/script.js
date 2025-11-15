document.addEventListener('DOMContentLoaded', function () {
    /* ===========================
       Modulo: Calendario drag & helpers
       =========================== */
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
            // Rimuovi listener precedenti per evitare duplicati
            container.removeEventListener('pointerdown', handlePointerDown);
            container.removeEventListener('pointerup', handlePointerUp);
            container.removeEventListener('pointerleave', handlePointerUp);
            container.removeEventListener('pointermove', handlePointerMove);

            // Aggiungi nuovi listener
            container.addEventListener('pointerdown', handlePointerDown);
            container.addEventListener('pointerup', handlePointerUp);
            container.addEventListener('pointerleave', handlePointerUp);
            container.addEventListener('pointermove', handlePointerMove);
        }
        
        // Gestori degli eventi
        function handlePointerDown(e) {
            if (e.button !== 0) return; // Solo tasto sinistro
            isPointerDown = true;
            isDragging = false;
            activeContainer = e.currentTarget;
            startX = e.pageX - activeContainer.offsetLeft;
            scrollLeft = activeContainer.scrollLeft;
            activeContainer.classList.add('dragging'); // Aggiungi classe per feedback visivo (opzionale)
        }

        function handlePointerUp(e) {
            if (isPointerDown) {
                activeContainer.classList.remove('dragging');
                isPointerDown = false;
                
                // Impedisce il click se c'è stato un trascinamento significativo
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
            e.preventDefault(); // Impedisce la selezione di testo
            
            const dx = e.pageX - activeContainer.offsetLeft - startX;
            
            // Verifica se il movimento è significativo per considerarlo "dragging"
            if (Math.abs(dx) > DRAG_THRESHOLD) {
                isDragging = true;
            }

            if (isDragging) {
                 // Sposta il contenitore orizzontalmente
                activeContainer.scrollLeft = scrollLeft - dx;
            }
        }
        
        // Rimuove i drag event dai link (per prevenire bug)
        function preventDragOnLinks(container) {
            container.querySelectorAll('a, button').forEach(el => {
                el.addEventListener('pointerdown', (e) => e.stopPropagation());
            });
        }


        /* ===========================
           Logica di Inizializzazione
           =========================== */
        
        const accordion = document.getElementById('calendarAccordion');
        
        if (accordion) {
             // 1. Inizializzazione per il contenitore drag-scroll quando si apre un accordion
            accordion.addEventListener('shown.bs.collapse', function (event) {
                const collapseBody = event.target;
                const calendarContainer = collapseBody.querySelector('.drag-scroll');
                
                if (calendarContainer) {
                    // Aggiunge la logica di drag and scroll
                    setupDragScroll(calendarContainer);
                    // Rimuove il drag sui link
                    preventDragOnLinks(calendarContainer);
                    // Centra la data odierna
                    centerToday(calendarContainer);
                }
            });
            
            // 2. Setup iniziale e centratura per i contenitori inizialmente visibili (la prima fila)
            document.querySelectorAll('#calendarAccordion .accordion-collapse.show .drag-scroll').forEach(container => {
                setupDragScroll(container);
                preventDragOnLinks(container);
                // Centra 'oggi' solo dopo che l'elemento è visibile e pronto
                centerToday(container);
                // Riprova a centrare 'oggi' al resize della finestra
                window.addEventListener('resize', () => centerToday(container));
            });
        }
        
        // Inizializzazione Tooltip di Bootstrap
        // Questo è necessario per il tooltip che hai aggiunto nella navbar
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
    } // fine initCalendarDragModule
    
    /* ===========================
       Inizializzazione moduli
       =========================== */
    initCalendarDragModule();



});