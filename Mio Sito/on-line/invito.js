document.addEventListener('keydown', function(a) {
    if (a.key === 'F12' || (a.ctrlKey && a.shiftKey && a.key === 'I')) {
        a.preventDefault();
        console.error('Tentativo di accesso alle funzionalità di sviluppo bloccato.');
    }
});

let button = document.getElementById("tasto");
button.addEventListener("click", recuperaValore);

function recuperaValore() {
    const nomeInput = document.getElementById("nome");
    const carneInput = document.getElementById("carne");
    const pesceInput = document.getElementById("pesce");

    const nome = nomeInput.value.trim();

    if (nome) {
        let messaggio = `Ciao, sono ${nome}`;

        if (carneInput.checked) {
            messaggio += ", e vorrei ordinare il menu vegetariano.";
        } else if (pesceInput.checked) {
            messaggio += ", e vorrei ordinare il menu di pesce.";
        }

        const whatsappLink = `https://wa.me/393298047791/?text=${encodeURIComponent(messaggio)}`;
        button.href = whatsappLink;
        button.target = "_blank";
    } else {
        alert("Inserisci il tuo nome per procedere.");
    }
}

