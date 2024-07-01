function mostraValore() {
    var input = document.getElementById('mioInput');
    var valore = input.value.toLowerCase();  // Convertiamo il valore dell'input in minuscolo per un confronto case-insensitive

    fetch('https://api.restful-api.dev/objects')
        .then(ex => ex.json())
        .then(posts => {
            // Pulisce il contenitore dei risultati prima di aggiungere nuovi elementi
            var resultContainer = document.getElementById('resultContainer');
            resultContainer.innerHTML = '';

            posts.forEach(element => {
                // Controlliamo se il valore dell'input è contenuto nel nome dell'elemento
                if (element.name.toLowerCase().includes(valore)) {
                    // Creiamo un nuovo elemento per il nome
                    var nameElement = document.createElement('p');
                    nameElement.innerHTML = `
                    Nome: ${element.name}<br>
                    Capacità: ${element.data.capacity}
                    `;

                    // Aggiungiamo il nuovo elemento al contenitore dei risultati
                    resultContainer.appendChild(nameElement);
                }
            });
        })
        .catch(error => {
            console.error("Errore nella richiesta fetch:", error);
        });
}
