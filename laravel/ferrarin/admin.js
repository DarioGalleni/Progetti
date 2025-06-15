// Funzione per caricare dinamicamente i dati con AJAX
function caricaTabella() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Inserisce la risposta PHP (HTML della tabella) nel div
            document.getElementById("tabellaUtenti").innerHTML = this.responseText;
        }
    };
    // Richiesta GET al file PHP
    xhr.open("GET", "get_users.php", true);
    xhr.send();
}

// Chiama la funzione non appena la pagina viene caricata
window.onload = caricaTabella;