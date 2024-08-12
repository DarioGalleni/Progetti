// document.addEventListener('keydown', function(a) {
//     if (a.key === 'F12' || (a.ctrlKey && a.shiftKey && a.key === 'I')) {
//           a.preventDefault();
//           alert("codice nascosto")
//       }
//     });


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


// navbar toggle
$('#nav-toggle').click(function(){
    $(this).toggleClass('is-active')
    $('ul.nav').toggleClass('show');
});

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

// navbar visibile allo scroll
let nav = document.getElementsByTagName('nav')[0];
window.addEventListener('scroll', function() {
    if (window.scrollY > 1) {
        nav.classList.remove('d-none'); 
    } else {
        nav.classList.add('d-none');
    }
});



//whatsapp
let submitButton = document.getElementById("whatsapp_submit");

submitButton.addEventListener("click", function(event) {

    event.preventDefault();
    
    let message = document.getElementById("whatsapp_message").value;
    let name = document.getElementById("whatsapp_name").value;

    let fullMessage = `Nome: ${name}%0A%0AMessaggio: ${message}`;
    let whatsappURL = `https://wa.me/393298047791?text=${fullMessage}`;

    window.open(whatsappURL, '_blank');

    document.getElementById("whatsapp_message").value = "";
    document.getElementById("whatsapp_name").value = "";
});

