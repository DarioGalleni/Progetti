let mostra = document.querySelector("#mostra");
let nascondi = document.querySelector("#nascondi");
let carosello = document.querySelector("#carosello");

mostra.addEventListener("click", function(){
    mostra.classList.add('d-none')
    carosello.classList.remove('d-none')
    nascondi.classList.remove('d-none')

});

nascondi.addEventListener("click", function(){

        mostra.classList.remove('d-none');
        carosello.classList.add('d-none');
    
});






let snowboards = [
    {'Tipo' : 'Freestyle', 'descrizione' : 'Tavole leggere e flessibili ottimali per salti, tricks e manovre in snowpark', 'price' : 300 , 'url': '/assets/img/snowboards/snowboards (1).webp'},
    {'Tipo' : 'Freeride', 'descrizione' : 'Tavole progettate per terreni fuoripista, offrendo galleggiamento sulla neve fresca e stabilità', 'price' : 350 , 'url': '/assets/img/snowboards/snowboards (2).webp'},
    {'Tipo' : 'All-Mountain', 'descrizione' : 'Tavole versatili adatte a vari terreni e condizioni di neve', 'price' : 400 , 'url': '/assets/img/snowboards/snowboards (3).webp'},
    {'Tipo' : 'Splitboard', 'descrizione' : "Tavole che possono essere divise in due per trasformarsi in sci da touring, ideali per l'escursionismo fuoripista", 'price' : 600 , 'url': '/assets/img/snowboards/snowboards (4).webp'},
    {'Tipo' : 'Powder', 'descrizione' : 'Tavole progettate per galleggiare sulla neve fresca e profonda', 'price' : 450 , 'url': '/assets/img/snowboards/snowboards (5).webp'},
    {'Tipo' : 'Camber', 'descrizione' : 'Tavole con un profilo curvo verso l\'esterno sotto i piedi, offrendo stabilità e pop', 'price' : 320 , 'url': '/assets/img/snowboards/snowboards (6).webp'},
    {'Tipo' : 'Rocker', 'descrizione' : 'Tavole con un profilo curvo verso l\'interno sotto i piedi, favoriscono la galleggiabilità e la manovrabilità', 'price' : 310 , 'url': '/assets/img/snowboards/snowboards (7).webp'},
    {'Tipo' : 'Hybrid', 'descrizione' : 'Tavole che combinano caratteristiche del camber e del rocker per massimizzare prestazioni in diverse condizioni', 'price' : 380 , 'url': '/assets/img/snowboards/snowboards (8).webp'},
    {'Tipo' : 'Directional', 'descrizione' : 'Tavole con una forma e una flex direzionali, ottimali per il carving e il controllo a alta velocità', 'price' : 370 , 'url': '/assets/img/snowboards/snowboards (9).webp'},
];

snowboards.forEach((item) => {
    let div = document.createElement('div');
    div.classList.add('swiper-slide', 'rounded', 'shadow');
    div.innerHTML = `

    <img id="images" class="rounded" src=".${item.url}" alt="snowboards">
    
    `;
    let swiperWrapper = document.querySelector(".swiper-wrapper");
    swiperWrapper.appendChild(div);
    });

    let button = document.querySelector('#darkmode');
    button.addEventListener("click", function() {
        let body = document.querySelector('body');
        body.classList.toggle('black');
    });


