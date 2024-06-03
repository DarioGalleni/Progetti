let recensioni = [
    {"nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente 1 notte assieme alla famiglia perchè eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno più lungo", "fonte": "images/tripadvisor.png"},

    {"nome": "mario", "recensione": "galleni"},
    {"nome": "mario", "recensione": "falleni"}
  ];

let reviews = document.querySelector("#reviews");

recensioni.forEach((element) => {
    let div = document.createElement("div");
    div.classList.add("carousel-item", "active");
    div.innerHTML = `<div style="border: 1px solid black;" class="container">
    <div class="row">
      <div class="col-6">
        <h2 class="text-end">Recensore: ${element.nome}</h2>
      </div>
      <div class="col-6">
      <img class="img-thumbnail" src="images/tripadvisor.png" alt="">
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h2 class="text-center">Recensione: ${element.recensione}</h2>
      </div>
    </div>
  </div>`;
    reviews.appendChild(div);
});
