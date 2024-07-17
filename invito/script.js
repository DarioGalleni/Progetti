let button = document.getElementById("tasto");

button.addEventListener("click", recuperaValore);

function recuperaValore() {
  // Recupera l'elemento input utilizzando il suo id
  var inputElement = document.getElementById('mioInput');
  let carne = document.getElementById("carne");
  let pesce = document.getElementById("pesce");

  // Ottieni il valore dell'input
  let inputValue = inputElement.value;
  let sceltaPesce = pesce.checked;
  let sceltaCarne = carne.checked;

  // Se l'input non è vuoto
  if (inputValue.length > 4) {
    let messaggio = `Ciao, sono ${inputValue}`;

    // Aggiungi testo in base alle checkbox selezionate
    if (sceltaCarne) {
      messaggio += ", e vorrei ordinare la carne.";
    }
    if (sceltaPesce) {
      messaggio += ", e vorrei ordinare il pesce.";
    }

    // Crea il link per Whatsapp
    let whatsappLink = `https://wa.me/393488289553/?text=${messaggio}`;

    // Aggiorna l'elemento <a> con il link
    let outputElement = document.getElementById('tasto');
    outputElement.href = whatsappLink;
    outputElement.target = "blank";


  } else {
    // Mostra un messaggio di avviso se l'input è vuoto
    alert("Inserisci il tuo nome");
  }
}