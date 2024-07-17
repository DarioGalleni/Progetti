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
$('#nav-toggle').click(function(){
    $(this).toggleClass('is-active')
    $('ul.nav').toggleClass('show');
});

// cv download
document.getElementById('downloadButton').addEventListener('click', function() {
    const fileUrl = '/assets/imgs/man.png';
    const fileName = 'Cv';
    const a = document.createElement('a');
    a.href = fileUrl;
    a.download = fileName;
    document.body.appendChild(a);
    a.click();
});

//
let nav = document.getElementsByTagName('nav')[0];
window.addEventListener('scroll', function() {
    if (window.scrollY > 1) {
        nav.classList.remove('d-none'); 
    } else {
        nav.classList.add('d-none');
    }
});
