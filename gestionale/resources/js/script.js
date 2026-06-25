document.addEventListener('DOMContentLoaded', () => {
    // --- SELEZIONE ELEMENTI COMUNI ---
    const slider = document.querySelector('.calendar-container');
    const header = document.getElementById('calendar-header');
    const arrivalInput = document.getElementById('arrival_date');
    const departureInput = document.getElementById('departure_date');
    const bookingForm = arrivalInput ? arrivalInput.closest('form') : null;

    // --- 1. GESTIONE SCROLL E DRAG DEL CALENDARIO ---
    if (slider) {
        let isDown = false;
        let startX;
        let scrollLeft;

        // Effetto scomparsa header allo scroll verticale
        if (header) {
            slider.addEventListener('scroll', () => {
                slider.scrollTop > 10
                    ? header.classList.add('header-hidden')
                    : header.classList.remove('header-hidden');
            });
        }

        // Implementazione Drag & Drop per lo scroll orizzontale
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        ['mouseleave', 'mouseup'].forEach(evt => {
            slider.addEventListener(evt, () => {
                isDown = false;
                slider.classList.remove('active');
            });
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });

        // Centramento automatico sulla data odierna o sul centro della griglia
        const todayEl = slider.querySelector('.today-column');
        const targetCenter = document.getElementById('center-date-header');

        if (targetCenter) {
            const containerWidth = slider.clientWidth;
            const roomColumnWidth = 150;
            const centerOffset = (containerWidth - roomColumnWidth) / 2;
            slider.scrollLeft = targetCenter.offsetLeft - roomColumnWidth - centerOffset + (targetCenter.clientWidth / 2);
        } else if (todayEl) {
            const elementCenter = todayEl.offsetLeft + (todayEl.offsetWidth / 2);
            const containerCenter = slider.clientWidth / 2;
            slider.scrollLeft = elementCenter - containerCenter;
        }
    }

    // --- 2. VALIDAZIONE DATE (CREAZIONE E MODIFICA) ---
    if (arrivalInput && departureInput && bookingForm) {
        const isEditPage = window.location.pathname.includes('/edit');
        const today = new Date().toISOString().split('T')[0];

        // Imposta il minimo per l'arrivo solo in creazione
        if (!isEditPage) {
            arrivalInput.setAttribute('min', today);
        }

        const validateDates = () => {
            let arrivalVal = arrivalInput.value;
            const departureVal = departureInput.value;

            if (!arrivalVal) return;

            // In creazione, impedisce date passate
            if (!isEditPage && arrivalVal < today) {
                alert('La data di arrivo non può essere nel passato.');
                arrivalInput.value = today;
                arrivalVal = today;
            }

            // Imposta il minimo per la partenza (almeno +1 giorno dall'arrivo)
            const arrDate = new Date(arrivalVal);
            arrDate.setDate(arrDate.getDate() + 1);
            const minDep = arrDate.toISOString().split('T')[0];
            departureInput.setAttribute('min', minDep);

            // Controllo coerenza logica
            if (departureVal && arrivalVal && departureVal <= arrivalVal) {
                departureInput.setCustomValidity('La data di partenza deve essere successiva all\'arrivo.');
            } else {
                departureInput.setCustomValidity('');
            }
        };

        arrivalInput.addEventListener('change', validateDates);
        departureInput.addEventListener('change', validateDates);
        validateDates();
    }

    // --- 3. GESTIONE NOTIFICHE (ALERT) ---
    const alerts = document.querySelectorAll('.alert-success');
    alerts.forEach(alertEl => {
        setTimeout(() => {
            const closeBtn = alertEl.querySelector('.btn-close');
            closeBtn ? closeBtn.click() : (alertEl.style.display = 'none');
        }, 10000);
    });

    // --- 4. GESTIONE GRUPPI (SELEZIONE/DESELEZIONE CHECKBOX) ---
    const selectAllBtn = document.getElementById('select-all');
    const deselectAllBtn = document.getElementById('deselect-all');

    if (selectAllBtn && deselectAllBtn) {
        const checkboxes = document.querySelectorAll('.room-checkbox');

        selectAllBtn.addEventListener('click', function () {
            checkboxes.forEach(cb => cb.checked = true);
        });

        deselectAllBtn.addEventListener('click', function () {
            checkboxes.forEach(cb => cb.checked = false);
        });
    }

    // --- 5. GESTIONE RICEVUTA FISCALE ---
    const receiptSpan = document.getElementById('receipt-number');
    if (receiptSpan) {
        window.print();
    }
});

// --- 6. STAMPA AUTOMATICA (LOAD COMPLETO) ---
window.addEventListener('load', function () {
    const isPrintExpensesPage = document.getElementById('print-expenses-page');
    const isCleaningPrintPage = document.getElementById('cleaning-print-page');

    if (isPrintExpensesPage || isCleaningPrintPage) {
        window.print();
    }
});

