document.addEventListener('DOMContentLoaded', function () {
    // Elementi per l'interfaccia delle spese aggiuntive dinamiche
    const addExpenseSelect = document.getElementById('add-expense-select');
    const expensesContainer = document.getElementById('additional-expenses-container');

    if (addExpenseSelect && expensesContainer) {
    // Gestisce la selezione di un tipo di spesa dal menu a tendina e aggiunge una riga di input
    addExpenseSelect.addEventListener('change', function () {
            const expense = this.value;
            if (!expense) return;

            if (expensesContainer.querySelector(`input[name="additional_expenses[${expense}]"]`)) {
                alert('Questa spesa è già stata aggiunta.');
                this.value = '';
                return;
            }

            const row = document.createElement('div');
            row.className = 'input-group mb-2';
            row.innerHTML = `
                <span class="input-group-text">${expense.charAt(0).toUpperCase() + expense.slice(1)}</span>
                <input type="number" step="0.01" class="form-control" name="additional_expenses[${expense}]" value="0.00" required>
                <button type="button" class="btn btn-danger remove-expense-btn">Rimuovi</button>
            `;
            expensesContainer.appendChild(row);
            this.value = '';
        });

    // Gestisce la rimozione delle righe di spesa aggiunte dinamicamente
        expensesContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-expense-btn')) {
                const group = e.target.closest('.input-group');
                if (group) group.remove();
            }
        });
    }

    const enableButton = document.getElementById('enable-night-mode');
    const disableButton = document.getElementById('disable-night-mode');
    const body = document.body;

    // Anima le icone del tema quando si alterna la modalità notte; clsIn=true => animazione-in, false => animazione-out
    function animateIcon(el, clsIn) {
        if (!el) return;
        el.classList.remove('anim-in', 'anim-out');
        // trigger reflow to restart animation
        void el.offsetWidth;
        el.classList.add(clsIn ? 'anim-in' : 'anim-out');
    }

    // Applica o rimuove gli stili della modalità notte e salva la preferenza in localStorage
    function applyNightMode(enabled) {
        const enableIcon = enableButton?.querySelector('.theme-icon');
        const disableIcon = disableButton?.querySelector('.theme-icon');

        if (enabled) {
            body.classList.add('night-mode');
            localStorage.setItem('nightMode', 'enabled');
            enableButton?.classList.add('hidden');
            disableButton?.classList.remove('hidden');
            animateIcon(disableIcon, true);
            animateIcon(enableIcon, false);
        } else {
            body.classList.remove('night-mode');
            localStorage.setItem('nightMode', 'disabled');
            enableButton?.classList.remove('hidden');
            disableButton?.classList.add('hidden');
            animateIcon(enableIcon, true);
            animateIcon(disableIcon, false);
        }
    }

    // Inizializza l'interfaccia in base alla preferenza di modalità notte salvata
    const stored = localStorage.getItem('nightMode');
    applyNightMode(stored === 'enabled');

    // Collega i gestori di click ai pulsanti di cambio tema
    if (enableButton) enableButton.addEventListener('click', () => applyNightMode(true));
    if (disableButton) disableButton.addEventListener('click', () => applyNightMode(false));

    const calendarContainer = document.getElementById('calendar-container');

    // Al caricamento, scorre il calendario per mostrare la colonna di oggi se presente
    window.addEventListener('load', function () {
        const todayCol = document.getElementById('today');
        if (todayCol && calendarContainer) calendarContainer.scrollLeft = todayCol.offsetLeft;
    });

    // Pulsanti che saltano il calendario a una colonna di data specifica
    document.querySelectorAll('.month-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.getElementById(this.dataset.targetId);
            if (target && calendarContainer) calendarContainer.scrollLeft = target.offsetLeft;
        });
    });

    if (!calendarContainer) return;

    // Abilita il comportamento di trascinamento per scorrere nel contenitore del calendario
    calendarContainer.classList.add('drag-scroll');

    let isPointerDown = false;
    let isDragging = false;
    let startX = 0, startY = 0;
    let scrollLeft = 0, scrollTop = 0;
    const DRAG_THRESHOLD = 4;

    // Avvio puntatore (mouse) per il trascinamento per scorrere
    calendarContainer.addEventListener('mousedown', (e) => {
        isPointerDown = true;
        isDragging = false;
        startX = e.pageX;
        startY = e.pageY;
        scrollLeft = calendarContainer.scrollLeft;
        scrollTop = calendarContainer.scrollTop;
    });

    // Fine del trascinamento del puntatore
    window.addEventListener('mouseup', () => {
        if (!isPointerDown) return;
        isPointerDown = false;
        calendarContainer.classList.remove('dragging');
        setTimeout(() => { isDragging = false; }, 0);
    });

    // Gestisce il movimento del puntatore e aggiorna la posizione di scorrimento durante il trascinamento
    window.addEventListener('mousemove', (e) => {
        if (!isPointerDown) return;
        const dx = e.pageX - startX;
        const dy = e.pageY - startY;
        if (!isDragging && Math.hypot(dx, dy) > DRAG_THRESHOLD) {
            isDragging = true;
            calendarContainer.classList.add('dragging');
        }
        if (isDragging) {
            e.preventDefault();
            calendarContainer.scrollLeft = scrollLeft - dx;
            calendarContainer.scrollTop = scrollTop - dy;
        }
    });

    // Previene eventi di click quando l'utente stava trascinando per evitare navigazioni accidentali
    calendarContainer.addEventListener('click', (e) => {
        if (isDragging) {
            e.preventDefault();
            e.stopPropagation();
        }
    }, true);

    let touchStartX = 0, touchStartY = 0, touchScrollLeft = 0, touchScrollTop = 0;
    // Gestori touch per il trascinamento (mobile) per scorrere
    calendarContainer.addEventListener('touchstart', (e) => {
        if (!e.touches || e.touches.length === 0) return;
        touchStartX = e.touches[0].pageX;
        touchStartY = e.touches[0].pageY;
        touchScrollLeft = calendarContainer.scrollLeft;
        touchScrollTop = calendarContainer.scrollTop;
        isDragging = false;
    }, { passive: true });

    calendarContainer.addEventListener('touchmove', (e) => {
        if (!e.touches || e.touches.length === 0) return;
        const dx = e.touches[0].pageX - touchStartX;
        const dy = e.touches[0].pageY - touchStartY;
        if (!isDragging && Math.hypot(dx, dy) > DRAG_THRESHOLD) {
            isDragging = true;
            calendarContainer.classList.add('dragging');
        }
        if (isDragging) {
            calendarContainer.scrollLeft = touchScrollLeft - dx;
            calendarContainer.scrollTop = touchScrollTop - dy;
        }
    }, { passive: true });

    calendarContainer.addEventListener('touchend', () => {
        isDragging = false;
        calendarContainer.classList.remove('dragging');
    });
});