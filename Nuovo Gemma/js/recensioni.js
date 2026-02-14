let recensioni = [
  { "nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente una notte assieme alla famiglia perch&egrave eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno pi&ugrave lungo" },
  { "nome": "Antonella", "recensione": "Bellissima esperienza !!! Hotel da consigliare!!! Posizione perfetta nel centro di marina di Pietrasanta... Personale disponibile camere pulite e comode... Torneremo sicuramente" },
  { "nome": "Sabrina", "recensione": "Bellissimo hotel a gestione familiare, dove ci si sente praticamente a casa. Ottima cucina, distanza dal mare circa 1 km. Possibilit&agrave di affittare biciclette. Parcheggio interno gratuito" },
  { "nome": "Martina", "recensione": "Purtroppo siamo rimasti solo una notte, il posto stupendo e a un passo dal mare. Gianni e Dario sono davvero accoglienti, professionali e super simpatici! Benessere e risate assicurate . Consigliatissimo, torneremo sicuramente in futuro !" },
  { "nome": "Francesco", "recensione": "Il personale &egrave molto cordiale e molto simpatico e l'hotel &egrave molto bello,lo consiglierei vivamente" },
];

let reviews = document.getElementById("reviews");

if (reviews) {
  recensioni.forEach((element) => {
    let div = document.createElement("div");
    // Remove fixed height, let content dictate, but ensure minimum for alignment
    div.className = "testimonial-card glass-card p-4 m-3 text-center d-flex flex-column";
    div.style.height = "100%";
    div.style.minHeight = "350px";

    div.innerHTML = `
            <div class="mb-3 text-primary"><i class="fas fa-quote-left fa-2x opacity-50"></i></div>
            <p class="font-italic text-white mb-4 flex-grow-1">"${element.recensione}"</p>
            <div class="mt-auto">
                <h5 class="font-weight-bold mb-1 text-primary text-uppercase" style="letter-spacing: 1px;">${element.nome}</h5>
                <div class="text-warning small">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        `;
    reviews.appendChild(div);
  });
}
