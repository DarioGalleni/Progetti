/* fotogallery.js - cleaned and formatted */

const fotogallery = [
  'big_1587569141301_1.jpg', 'big_1587569141305_1.jpg', 'big_1587569142103.jpg',
  'big_1587569317302_1.jpg', 'big_1587569541303_1.jpg', 'big_1587569541304_3.jpg',
  'big_1587652104_DSC7541.jpg', 'big_1587652104_DSC7546.jpg', 'big_1587652105_DSC7547.jpg',
  'big_1587652105_DSC7549.jpg', 'big_1587652108_DSC7680.jpg', 'big_1587652108_DSC7682.jpg',
  'big_1587652110_DSC7704-Pano.jpg', 'big_1587652151_DSC7741.jpg', 'big_1587652151_DSC7742.jpg',
  'big_1587652152_DSC7745.jpg', 'big_1587652153_DSC7749.jpg', 'big_1587652153_DSC7755.jpg',
  'big_1587652154_DSC7761.jpg', 'big_1587652155_DSC7767.jpg'
];

const swiperWrapper = document.querySelector('.swiper-wrapper');
const fotosmartphone = document.querySelector('#smartphone');

if (swiperWrapper) {
  fotogallery.forEach(image => {
    const slide = document.createElement('div');
    slide.className = 'swiper-slide';
    const img = document.createElement('img');
    img.className = 'img-fluid rounded shadow-lg p-3 bg-body-tertiary';
    img.src = `/gallery/photogallery/${image}`;
    img.alt = 'foto';
    slide.appendChild(img);
    swiperWrapper.appendChild(slide);
  });
}

if (fotosmartphone) {
  fotogallery.forEach(image => {
    const col = document.createElement('div');
    col.className = 'col-12 p-1';
    col.setAttribute('data-aos', 'zoom-out');
    col.setAttribute('data-aos-duration', '3000');
    col.setAttribute('data-aos-delay', '500');

    const img = document.createElement('img');
    img.className = 'img-fluid my-3 rounded shadow-lg p-3 bg-body-tertiary';
    img.src = `/gallery/photogallery/${image}`;
    img.alt = 'foto';

    col.appendChild(img);
    fotosmartphone.appendChild(col);
  });
}

