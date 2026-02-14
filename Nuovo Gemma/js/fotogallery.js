
(function ($) {
    'use strict';

    // ALBUMFOTO CONTIENE TUTTE LE FOTO NELLA CARTELLA OMONIMA   
    let fotogallery = [
        'big_1587569141301_1.jpg', 'big_1587569141305_1.jpg', 'big_1587569142103.jpg',
        'big_1587569317302_1.jpg', 'big_1587569541303_1.jpg', 'big_1587569541304_3.jpg',
        'big_1587652104_DSC7541.jpg', 'big_1587652104_DSC7546.jpg', 'big_1587652105_DSC7547.jpg',
        'big_1587652105_DSC7549.jpg', 'big_1587652108_DSC7680.jpg', 'big_1587652108_DSC7682.jpg',
        'big_1587652110_DSC7704-Pano.jpg', 'big_1587652151_DSC7741.jpg', 'big_1587652151_DSC7742.jpg',
        'big_1587652152_DSC7745.jpg', 'big_1587652153_DSC7749.jpg', 'big_1587652153_DSC7755.jpg',
        'big_1587652154_DSC7761.jpg', 'big_1587652155_DSC7767.jpg', 'big_1587652156102.jpg',
        'big_1587652156103.jpg', 'big_1587652157103_1.jpg', 'big_1587652158301_1.jpg',
        'big_1587652213301_2.jpg', 'big_1587652213301_3.jpg', 'big_1587652214302_1.jpg',
        'big_1587652214302_2.jpg', 'big_1587652215302_3.jpg', 'big_1587652215302_4.jpg',
        'big_1587652216303_1.jpg', 'big_1587652216303_2.jpg', 'big_1587652217303_3.jpg',
        'big_1587652218304_1.jpg', 'big_1587652218304_2.jpg', 'big_1587652219304_3.jpg',
        'big_1587652219304_4.jpg', 'big_1587652220305_1.jpg', 'big_1587652220305_2.jpg',
        'big_1587652221big_home-page-standard-album-relax-e-tranquillita-2105.jpg',
        'big_1587652221sala-1.jpg', 'big_1587652221Sala.jpg', 'big_1587652222Scale.jpg',
        'big_1587652222Soffitto.jpg'
    ];

    let galleryRow = document.getElementById("gallery-row");
    if (galleryRow) {
        fotogallery.forEach((element, index) => {
            let div = document.createElement("div");
            // Bootstrap Grid Classes
            div.className = "col-6 col-md-4 col-lg-3 mb-4";

            // Modern styling with glass card effect + Fancybox + Lazy Loading
            div.innerHTML = `
            <div class="glass-card p-1 h-100 border-0 shadow-sm transition-hover">
               <a href="images/photogallery/${element}" data-fancybox="gallery" data-caption="Hotel Gemma del Mare - Foto ${index + 1}">
                  <img class="img-fluid rounded w-100 h-100" src="images/photogallery/${element}" alt="foto hotel gemma del mare" style="object-fit: cover; min-height: 200px; max-height: 200px;" loading="lazy">
               </a>
            </div>
            `;
            galleryRow.appendChild(div);
        });
    }

})(jQuery);