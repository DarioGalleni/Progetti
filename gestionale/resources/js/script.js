document.addEventListener('DOMContentLoaded', function () {

    //! Spese aggiuntive prenotazione (Questa parte rimane invariata)
    const addExpenseSelect = document.getElementById('add-expense-select');
    const expensesContainer = document.getElementById('additional-expenses-container');

    if (addExpenseSelect) { // Aggiunto un controllo per sicurezza
        addExpenseSelect.addEventListener('change', function () {
            const expense = this.value;
            if (expense) {
                if (expensesContainer.querySelector(`input[name="additional_expenses[${expense}]"]`)) {
                    alert('Questa spesa è già stata aggiunta.');
                    return;
                }
                const newExpenseRow = document.createElement('div');
                newExpenseRow.classList.add('input-group', 'mb-2');
                newExpenseRow.innerHTML = `
                    <span class="input-group-text expense-label">${expense.charAt(0).toUpperCase() + expense.slice(1)}</span>
                    <input type="number" step="0.01" class="form-control expense-amount" name="additional_expenses[${expense}]" value="0.00" required>
                    <button type="button" class="btn btn-danger remove-expense-btn">Rimuovi</button>
                `;
                expensesContainer.appendChild(newExpenseRow);
                this.value = '';
            }
        });
    }

    if (expensesContainer) { // Aggiunto un controllo per sicurezza
        expensesContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-expense-btn')) {
                e.target.closest('.input-group').remove();
            }
        });
    }

    //! Modalità notte (Questa parte rimane invariata)
    const toggleButton = document.getElementById('night-mode-toggle');
    const body = document.body;
    if (localStorage.getItem('nightMode') === 'enabled') {
        body.classList.add('night-mode');
    }
    if (toggleButton) { // Aggiunto un controllo per sicurezza
        toggleButton.addEventListener('click', () => {
            body.classList.toggle('night-mode');
            if (body.classList.contains('night-mode')) {
                localStorage.setItem('nightMode', 'enabled');
            } else {
                localStorage.setItem('nightMode', 'disabled');
            }
        });
    }

    // --- INIZIO CODICE MODIFICATO ---

    const calendarContainer = document.getElementById('calendar-container');

    //! Centra la data di oggi
    // CAMBIAMENTO: Usiamo 'window.addEventListener('load', ...)' invece di eseguire il codice subito.
    // Questo assicura che tutti gli stili siano stati applicati e le dimensioni siano corrette.
    window.addEventListener('load', function () {
        const todayColumn = document.getElementById('today');
        if (todayColumn && calendarContainer) {
            const containerWidth = calendarContainer.offsetWidth;
            const columnWidth = todayColumn.offsetWidth;
            // La formula era già corretta, il problema era solo il "quando" veniva eseguita
            const scrollPosition = todayColumn.offsetLeft - (containerWidth / 2) + (columnWidth / 2);
            calendarContainer.scrollLeft = scrollPosition;
        }
    });

    //! Pulsanti dei mesi (Codice refattorizzato e corretto)
    // MIGLIORAMENTO: Invece di 4 funzioni separate, ne usiamo una sola per tutti i pulsanti.
    // Selezioniamo tutti i pulsanti che hanno la classe 'month-btn' (che aggiungeremo nell'HTML).
    const monthButtons = document.querySelectorAll('.month-btn');

    monthButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Previene il comportamento predefinito del link

            // Otteniamo l'ID della colonna a cui scorrere da un attributo 'data-target-id' che aggiungeremo al pulsante
            const targetId = this.getAttribute('data-target-id');
            const targetDay = document.getElementById(targetId);

            if (targetDay && calendarContainer) {
                // SEMPLIFICAZIONE: La posizione di scorrimento è semplicemente la distanza dell'elemento
                // dall'inizio del suo contenitore.
                calendarContainer.scrollLeft = targetDay.offsetLeft;
            }
        });
    });

    // --- FINE CODICE MODIFICATO ---
});