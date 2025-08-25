
// navbar toggle
$('#nav-toggle').click(function(){
    $(this).toggleClass('is-active')
    $('ul.nav').toggleClass('show');
});

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

