AOS.init()
  document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault(); // Previene l'invio immediato del form

    // Mostra lo spinner
    document.getElementById("spinner").classList.remove("d-none");

    // Nascondi il pulsante per evitare clic ripetuti
    document.getElementById("button").disabled = true;

    // Simula un ritardo di 3 secondi (3000 millisecondi)
    setTimeout(function() {
      // Nascondi lo spinner dopo 3 secondi
      document.getElementById("spinner").classList.add("d-none");

      // Procedi con l'invio del form
      document.getElementById("form").submit();
    }, 3000);
  });