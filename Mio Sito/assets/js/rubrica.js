/*
    Rubrica JS
    Poiché la logica di salvataggio è ora gestita da PHP (Server-Side),
    questo script serve SOLO per l'esperienza utente (UX):
    - Filtro di ricerca in tempo reale (nasconde/mostra elementi DOM già renderizzati)
*/

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const noResultsElement = document.getElementById('noResults');

    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const searchQuery = this.value.toLowerCase();
            const contacts = document.querySelectorAll('.contact-item');
            let hasResults = false;

            contacts.forEach(contact => {
                const name = contact.querySelector('h5').innerText.toLowerCase();
                const phone = contact.querySelector('p').innerText.toLowerCase();

                if (name.includes(searchQuery) || phone.includes(searchQuery)) {
                    contact.style.display = 'flex';
                    hasResults = true;
                } else {
                    contact.style.display = 'none';
                }
            });

            // Mostra messaggio se nessun risultato dalla ricerca
            // (Nota: se la lista è vuota da PHP, l'altro empty-state è già visibile)
            if (noResultsElement) {
                if (hasResults) {
                    noResultsElement.style.display = 'none';
                } else if (contacts.length > 0) {
                    // Mostra solo se ci sono contatti ma la ricerca non ne trova
                    noResultsElement.style.display = 'block';
                }
            }
        });
    }

});
