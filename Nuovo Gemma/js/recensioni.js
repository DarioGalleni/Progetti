let recensioni = [
    {"nome": "Francesca", "recensione": "Sono stata alla Gemma del Mare solamente una notte assieme alla famiglia perchè eravamo in visita a parenti. Staff gentile e accogliente, posto incantevole e a pochi passi dalla spiaggia. Spero di riuscire a tornarci per un soggiorno più lungo", "fonte": "images/tripadvisor.png"},
    {"nome": "Antonella", "recensione": "Bellissima esperienza !!! Hotel da consigliare!!! Posizione perfetta nel centro di marina di Pietrasanta... Personale disponibile camere pulite e comode... Torneremo sicuramente", "fonte":"images/google.png"},
    {"nome": "mario", "recensione": "falleni"}
    
  ];

let reviews = document.querySelector("#reviews");

recensioni.forEach((element) => {
    let div = document.createElement("div");
    div.classList.add("carousel-item", "active");
  //   div.innerHTML = `<div class="container">
  //   <div class="row">
  //     <div class="col-6 ">
  //       <h2 class="text-center">Recensore: ${element.nome}</h2>
  //     </div>
  //     <div class="col-6 d-flex justify-content-center">
  //       <img src="images/tripadvisor.png" height="50px" class="" alt="">
  //     </div>
  //   </div>
  //   <div class="row">
  //     <div class="col-12 mt-3">
  //       <h2 class="text-center">Recensione: ${element.recensione}</h2>
  //     </div>
  //   </div>
  // </div>`;
  div.innerHTML = `<div class="card border-white">
  <div class="card-header d-flex row justify-content-between text-center">
    <div class="col-6 my-auto">
      <h5>${element.nome}</h5>
    </div>
    <div class="col-6">
      <img src="${element.fonte}" alt="">
    </div>
  </div>
  <div class="card-body">
    <p class="card-text text-center">${element.recensione}</p>
  </div>
</div>`
    reviews.appendChild(div);
});
