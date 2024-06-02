let recensioni = [
    {"nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente 1 notte assieme alla famiglia perchè eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno più lungo"},

    {"nome": "mario", "recensione": "galleni"}
  ];

let sliderItem = document.querySelector(".slider-item");

recensioni.forEach((element) => {
    let p = document.createElement("p");
    p.innerHTML = `Recensore: ${element.nome} Recensione: ${element.recensione}`;
    swiperWrapper.appendChild(p);
});
