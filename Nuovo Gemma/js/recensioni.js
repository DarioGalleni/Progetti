let recensioni = [
  { "nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente una notte assieme alla famiglia perch&egrave eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno pi&ugrave lungo" },
  { "nome": "Antonella", "recensione": "Bellissima esperienza !!! Hotel da consigliare!!! Posizione perfetta nel centro di marina di Pietrasanta... Personale disponibile camere pulite e comode... Torneremo sicuramente" },
  { "nome": "Sabrina", "recensione": "Bellissimo hotel a gestione familiare, dove ci si sente praticamente a casa. Ottima cucina, distanza dal mare circa 1 km. Possibilit&agrave di affittare biciclette. Parcheggio interno gratuito" },
  { "nome": "Martina", "recensione": "Purtroppo siamo rimasti solo una notte, il posto stupendo e a un passo dal mare. Gianni e Dario sono davvero accoglienti, professionali e super simpatici! Benessere e risate assicurate . Consigliatissimo, torneremo sicuramente in futuro !" },
  { "nome": "Francesco", "recensione": "Il personale &egrave molto cordiale e molto simpatico e l'hotel &egrave molto bello,lo consiglierei vivamente" },
  { "nome": "Alessandro", "recensione": "Un soggiorno indimenticabile! La gentilezza di Dario e Gianni &egrave; unica. Camere pulitissime e colazione abbondante. Torneremo sicuramente l'anno prossimo!" },
  { "nome": "Giulia", "recensione": "Posizione strategica vicino al mare e al centro. L'atmosfera familiare ti fa sentire subito a casa. Consigliatissimo per chi cerca relax e cortesia." },
  { "nome": "Marco", "recensione": "Abbiamo passato una settimana fantastica. Servizio impeccabile, biciclette a disposizione e un parcheggio comodissimo. Grazie di tutto!" },
  { "nome": "Elena", "recensione": "Tutto perfetto! Dalla pulizia delle camere alla disponibilit&agrave; dello staff. Un vero gioiello a Marina di Pietrasanta. A presto!" },
  { "nome": "Davide", "recensione": "Ottimo rapporto qualit&agrave;-prezzo. I proprietari sono persone squisite, sempre pronti a dare consigli su dove mangiare e cosa visitare. Consigliato!" },
  { "nome": "Simona", "recensione": "Un weekend di puro relax. La struttura &egrave; accogliente e ben curata. La vicinanza alla spiaggia &egrave; un grande plus. Ci siamo trovati benissimo." },
  { "nome": "Roberto", "recensione": "Siamo clienti abituali ormai. Ogni volta &egrave; come tornare in famiglia. Non cambieremmo questo hotel con nessun altro in zona!" },
  { "nome": "Chiara", "recensione": "Ho apprezzato molto la tranquillit&agrave; e la pulizia. Colazione varia e di qualit&agrave;. Gianni e Dario sono dei padroni di casa eccezionali." },
  { "nome": "Luigi", "recensione": "Vacanza perfetta. Le camere sono spaziose e dotate di ogni comfort. Il giardino &egrave; un'oasi di pace. Complimenti allo staff!" },
  { "nome": "Valentina", "recensione": "Un'accoglienza calorosa che ti resta nel cuore. Hotel molto carino, pulito e funzionale. Ideale per famiglie e coppie. Torneremo presto!" },
];

let reviews = document.getElementById("reviews");

if (reviews) {
  recensioni.forEach((element) => {
    let div = document.createElement("div");
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
