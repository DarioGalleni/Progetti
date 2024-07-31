let recensioni = [
    {"nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente una notte assieme alla famiglia perch&egrave eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno pi&ugrave lungo"},
    {"nome": "Antonella", "recensione": "Bellissima esperienza !!! Hotel da consigliare!!! Posizione perfetta nel centro di marina di Pietrasanta... Personale disponibile camere pulite e comode... Torneremo sicuramente"},
    {"nome": "Sabrina", "recensione": "Bellissimo hotel a gestione familiare, dove ci si sente praticamente a casa. Ottima cucina, distanza dal mare circa 1 km. Possibilit&agrave di affittare biciclette. Parcheggio interno gratuito"},
    {"nome": "Martina", "recensione": "Purtroppo siamo rimasti solo una notte, il posto stupendo e a un passo dal mare. Gianni e Dario sono davvero accoglienti, professionali e super simpatici! Benessere e risate assicurate . Consigliatissimo, torneremo sicuramente in futuro !"},
    {"nome": "Francesco", "recensione": "Il personale &egrave molto cordiale e molto simpatico e l'hotel &egrave molto bello,lo consiglierei vivamente"},   
  ];

let reviews = document.getElementById("reviews");

recensioni.forEach((element) => {
    let div = document.createElement("div");
    div.style.minHeight = "300px"
    div.innerHTML = `<p class="fst-italic">${element.recensione}}</p>
            <div class="d-flex justify-content-center align-items-end">
              <p class="fst-italic">${element.nome}</p>
            </div>`
    reviews.appendChild(div);
});
