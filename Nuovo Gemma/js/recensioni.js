let recensioni = [
    {"nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente una notte assieme alla famiglia perchè eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno più lungo"},
    {"nome": "Antonella", "recensione": "Bellissima esperienza !!! Hotel da consigliare!!! Posizione perfetta nel centro di marina di Pietrasanta... Personale disponibile camere pulite e comode... Torneremo sicuramente"},
    {"nome": "Sabrina", "recensione": "Bellissimo hotel a gestione familiare, dove ci si sente praticamente a casa. Ottima cucina, distanza dal mare circa 1 km. Possibilità di affittare biciclette. Parcheggio interno gratuito"},   
  ];

let reviews = document.querySelector(".js-carousel-2");

recensioni.forEach((element) => {
    let div = document.createElement("div");
    div.style.minHeight = "300px"
    div.innerHTML = `<p class="fst-italic">${element.recensione}}</p>
            <div class="d-flex justify-content-center align-items-end">
              <p class="fst-italic">${element.nome}</p>
            </div>`
    reviews.appendChild(div);
});
