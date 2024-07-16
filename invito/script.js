let button = document.getElementById("tasto");

button.addEventListener("click", recuperaValore);

function recuperaValore() {
    // Recupera l'elemento input utilizzando il suo id
    var inputElement = document.getElementById('mioInput');

    // Ottieni il valore dell'input
    let inputValue = inputElement.value

    // Se l'input non è vuoto
    if (inputValue.length > 4) {
        // Crea il link per Whatsapp
        let whatsappLink = `https://wa.me/393298047791/?text=Ciao%20sono%20${inputValue}`;

        // Aggiorna l'elemento <a> con il link
        let outputElement = document.getElementById('tasto');
        outputElement.href = whatsappLink;
        outputElement.target = "blank"
        
    } else {
        // Mostra un messaggio di avviso se l'input è vuoto
        alert("Inserisci il tuo nome");
    }
}




