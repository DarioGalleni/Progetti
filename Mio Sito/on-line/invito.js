document.addEventListener("DOMContentLoaded", function() {
    // Recupera il valore dal localStorage
    let username = localStorage.getItem("username");
    
    // Controlla se l'utente ha passato la verifica
    if (!username) {
        // Se non c'è username nel localStorage, reindirizza alla prima pagina
        window.location.href = "index.html";
        return;
    }

let button = document.getElementById("tasto")
button.addEventListener("click", recuperaValore);

function recuperaValore() {
      // Recupera l'elemento input utilizzando il suo id
    let carne = document.getElementById("carne");
    let pesce = document.getElementById("pesce");

      // Ottieni il valore dell'input
    let sceltaPesce = pesce.checked;
    let sceltaCarne = carne.checked;

      // Se l'input non è vuoto
    if (username) {
        let messaggio = `Ciao, sono ${username}`;

          // Aggiungi testo in base alle checkbox selezionate
        if (sceltaCarne) {
            messaggio += ", e vorrei ordinare il menu vegetariano.";
        } else if (sceltaPesce) {
            messaggio += ", e vorrei ordinare il menu di pesce.";
        }

          // Crea il link per Whatsapp
        let whatsappLink = `https://wa.me/393298047791/?text=${(messaggio)}`;

          // Aggiorna l'elemento <a> con il link
        let outputElement = document.getElementById('tasto');
        outputElement.href = whatsappLink;
        outputElement.target = "_blank";
    } else {
          // Mostra un messaggio di avviso se l'input è vuoto
        alert("Inserisci il tuo nome");
    }
}
});