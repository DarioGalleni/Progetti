// $(document).ready(function(){
//     $(".navbar .nav-link").on('click', function(event) {

//         if (this.hash !== "") {

//             event.preventDefault();

//             var hash = this.hash;

//             $('html, body').animate({
//                 scrollTop: $(hash).offset().top
//             }, 700, function(){
//                 window.location.hash = hash;
//             });
//         } 
//     });
// });

// // navbar toggle
// $('#nav-toggle').click(function(){
//     $(this).toggleClass('is-active')
//     $('ul.nav').toggleClass('show');
// });

// cv download
// document.getElementById('downloadButton').addEventListener('click', function() {
//     const fileUrl = '/assets/imgs/man.png';
//     const fileName = 'Cv';
//     const a = document.createElement('a');
//     a.href = fileUrl;
//     a.download = fileName;
//     document.body.appendChild(a);
//     a.click();
// });

//navbar scroll
// let nav = document.getElementsByTagName('nav')[0];
// window.addEventListener('scroll', function() {
//     if (window.scrollY > 1) {
//         nav.classList.remove('d-none'); 
//     } else {
//         nav.classList.add('d-none');
//     }
// });

document.getElementById("no").addEventListener("click", function() {
    let div = document.getElementsByClassName("cena")[0];
    div.classList.add("d-none");
});

document.getElementById("si").addEventListener("click", function() {
    let div = document.getElementsByClassName("cena")[0];
    div.classList.add("d-none");
    let controllo = document.getElementsByClassName("controllo")[0];
    controllo.classList.remove("d-none");
});

// controllo
let check = document.getElementById("check");
let verifica = document.getElementById("verifica");

verifica.addEventListener("click", function() {   
    let nomi = [
        "matteo", "marica", "francesco", "alessia", "alice", "mirko", 
        "beatrice", "federica", "francesca", "giulia", "ilaria", "irene", 
        "jessica", "mary", "mery", "serena", "silvia", "simone", 
        "tommaso", "valentina", "veronica", "dario"
    ];
    
    if (nomi.includes(check.value.toLowerCase())) {
        // Salva il valore nel localStorage
        localStorage.setItem("username", check.value);

        // Reindirizza alla pagina invito.html
        window.location.href = "invito.html";
    } else {
        let denied = document.getElementsByClassName("denied")[0];
        denied.classList.remove("d-none");
        let controllo = document.getElementsByClassName("controllo")[0];
        controllo.classList.add("d-none");
    }
});
