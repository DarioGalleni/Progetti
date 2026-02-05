document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.calendar-container');
    const header = document.getElementById('calendar-header');

    // Gestione scroll header
    if (slider && header) {
        slider.addEventListener('scroll', () => {
            if (slider.scrollTop > 10) {
                header.classList.add('header-hidden');
            } else {
                header.classList.remove('header-hidden');
            }
        });
    }

    // Gestione Drag & Drop scroll
    if (slider) {
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2;
            slider.scrollLeft = scrollLeft - walk;
        });

        const todayEl = slider.querySelector('.today-column');
        if (todayEl) {
            const elementCenter = todayEl.offsetLeft + (todayEl.offsetWidth / 2);
            const containerCenter = slider.clientWidth / 2;
            slider.scrollLeft = elementCenter - containerCenter;
        } else {
            const gridWidth = slider.scrollWidth;
            const clientWidth = slider.clientWidth;
            if (gridWidth > clientWidth) {
                slider.scrollLeft = (gridWidth - clientWidth) / 2;
            }
        }
    }

    // Chiusura alert
    const alertEl = document.querySelector('.alert-success');
    if (alertEl) {
        setTimeout(() => {
            const closeBtn = alertEl.querySelector('.btn-close');
            if (closeBtn) {
                closeBtn.click();
            } else {
                alertEl.style.display = 'none';
            }
        }, 10000);
    }

    // Validazione date (solo per form di creazione, non di modifica)
    const arrivalInput = document.getElementById('arrival_date');
    const departureInput = document.getElementById('departure_date');
    const bookingForm = arrivalInput ? arrivalInput.closest('form') : null;
    
    // Applica validazione solo se NON siamo in una pagina di modifica
    const isEditPage = window.location.pathname.includes('/edit');

    if (arrivalInput && departureInput && bookingForm && !isEditPage) {
        const today = new Date().toISOString().split('T')[0];
        arrivalInput.setAttribute('min', today);

        function validateDates() {
            const arrivalVal = arrivalInput.value;
            const departureVal = departureInput.value;

            if (!arrivalVal) return;

            if (arrivalVal < today) {
                alert('La data di arrivo non può essere nel passato.');
                arrivalInput.value = today;
                return;
            }

            if (arrivalVal) {
                const arrDate = new Date(arrivalVal);
                arrDate.setDate(arrDate.getDate() + 1);
                const minDep = arrDate.toISOString().split('T')[0];
                departureInput.setAttribute('min', minDep);
            }

            if (departureVal && arrivalVal && departureVal <= arrivalVal) {
                departureInput.setCustomValidity('La data di partenza deve essere successiva all\'arrivo.');
            } else {
                departureInput.setCustomValidity('');
            }
        }

        arrivalInput.addEventListener('change', validateDates);
        departureInput.addEventListener('change', validateDates);
        validateDates();

        bookingForm.addEventListener('submit', (e) => {
            if (arrivalInput.value < today) {
                e.preventDefault();
                alert('La data di arrivo non deve essere nel passato.');
            }
            if (departureInput.value <= arrivalInput.value) {
                e.preventDefault();
                alert('La data di partenza deve essere successiva alla data di arrivo.');
            }
        });
    } else if (arrivalInput && departureInput && bookingForm && isEditPage) {
        // Per le pagine di modifica, valida solo che partenza > arrivo (senza vincoli sul passato)
        function validateDatesEdit() {
            const arrivalVal = arrivalInput.value;
            const departureVal = departureInput.value;

            if (arrivalVal) {
                const arrDate = new Date(arrivalVal);
                arrDate.setDate(arrDate.getDate() + 1);
                const minDep = arrDate.toISOString().split('T')[0];
                departureInput.setAttribute('min', minDep);
            }

            if (departureVal && arrivalVal && departureVal <= arrivalVal) {
                departureInput.setCustomValidity('La data di partenza deve essere successiva all\'arrivo.');
            } else {
                departureInput.setCustomValidity('');
            }
        }

        arrivalInput.addEventListener('change', validateDatesEdit);
        departureInput.addEventListener('change', validateDatesEdit);
        validateDatesEdit();

        bookingForm.addEventListener('submit', (e) => {
            if (departureInput.value <= arrivalInput.value) {
                e.preventDefault();
                alert('La data di partenza deve essere successiva alla data di arrivo.');
            }
        });
    }
});