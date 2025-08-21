document.addEventListener('DOMContentLoaded', function () {
    //! Spese aggiuntive prenotazione
    const addExpenseSelect = document.getElementById('add-expense-select');
    const expensesContainer = document.getElementById('additional-expenses-container');

    if (addExpenseSelect && expensesContainer) {
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

        expensesContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-expense-btn')) {
                const group = e.target.closest('.input-group');
                if (group) group.remove();
            }
        });
    }

    //! Modalità notte
    const toggleButton = document.getElementById('night-mode-toggle');
    const body = document.body;
    if (localStorage.getItem('nightMode') === 'enabled') {
        body.classList.add('night-mode');
    }
    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            body.classList.toggle('night-mode');
            localStorage.setItem('nightMode', body.classList.contains('night-mode') ? 'enabled' : 'disabled');
        });
    }

    const calendarContainer = document.getElementById('calendar-container');

    //! Centra la data di oggi
    window.addEventListener('load', function () {
        const todayCol = document.getElementById('today');
        if (todayCol && calendarContainer) {
            calendarContainer.scrollLeft = todayCol.offsetLeft;
        }
    });

    //! Pulsanti dei mesi
    document.querySelectorAll('.month-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.dataset.targetId;
            const target = document.getElementById(targetId);
            if (target && calendarContainer) {
                calendarContainer.scrollLeft = target.offsetLeft;
            }
        });
    });
});