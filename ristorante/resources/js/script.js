document.addEventListener('DOMContentLoaded', () => {

    // Visibilità della barra di navigazione durante lo scorrimento
    const navbar = document.getElementsByClassName('navbar')[0];
    if (navbar) {
        const handleNavbar = () => {
            if (window.scrollY > 0) navbar.classList.remove('d-none');
            else navbar.classList.add('d-none');
        };
        window.addEventListener('scroll', handleNavbar);
        handleNavbar();
    }

    // Imposta l'anno corrente
    const annoCorrente = document.getElementById('anno-corrente');
    if (annoCorrente) {
        annoCorrente.textContent = new Date().getFullYear();
    }

    // Riproduzione automatica dei video quando sono visibili almeno al 50% 
    const options = { threshold: 0.5 };
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target;
            const source = video.querySelector('source');

            if (entry.isIntersecting) {
                if (source && (!source.src || source.src === '')) {
                    source.src = source.dataset.src || video.dataset.src || source.getAttribute('data-src') || video.getAttribute('data-src') || '';
                    video.load();
                }
                video.muted = true;
                const playPromise = video.play();
                if (playPromise && playPromise.catch) playPromise.catch(() => {});
            } else {
                if (!video.paused) {
                    video.pause();
                    try { video.currentTime = 0; } catch (e) {}
                }
            }
        });
    }, options);

    document.querySelectorAll('video.autoplay-on-view').forEach(v => io.observe(v));
});

// navbar

document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        const sectionTitles = document.querySelectorAll('.section-title');
        let lastScrollY = window.scrollY;
        let firstTitlePosition = 0;
        
        if (sectionTitles.length > 0) {
            firstTitlePosition = sectionTitles[0].getBoundingClientRect().top + window.scrollY;
        }
        
        function handleScroll() {
            const currentScrollY = window.scrollY;
            
            // Se lo scroll ha raggiunto almeno il primo titolo di sezione
            if (currentScrollY >= firstTitlePosition) {
                // Mostra navbar quando si scorre verso il basso
                if (currentScrollY > lastScrollY) {
                    navbar.classList.remove('hidden-navbar');
                    navbar.classList.add('visible-navbar');
                } 
                // Nascondi navbar quando si scorre verso l'alto
                else if (currentScrollY < lastScrollY) {
                    navbar.classList.remove('visible-navbar');
                    navbar.classList.add('hidden-navbar');
                }
            } else {
                // Se prima del primo titolo, nascondi sempre
                navbar.classList.remove('visible-navbar');
                navbar.classList.add('hidden-navbar');
            }
            
            lastScrollY = currentScrollY;
        }
        
        // Attiva lo scroll listener
        window.addEventListener('scroll', handleScroll);
    });

    // Rendere efficace il clic sul pulsante #download-menu
    document.addEventListener('DOMContentLoaded', function () {
        var btn = document.getElementById('download-menu');
        if (!btn) return;

        btn.addEventListener('click', async function (e) {
            e.preventDefault();
            var url = btn.getAttribute('data-href') || btn.getAttribute('href') || '/menu';

            try {
                var res = await fetch(url, { method: 'GET' });
                if (!res.ok) throw new Error('Network response was not ok (' + res.status + ')');

                var contentType = res.headers.get('content-type') || '';
                if (contentType.indexOf('text/html') === 0) {
                    window.open(url, '_blank');
                    return;
                }

                var filename = 'menu.pdf';
                var cd = res.headers.get('content-disposition') || '';
                var m = cd.match(/filename\*=UTF-8''([^;\n\r]+)/i) || cd.match(/filename=?"?([^";]+)"?/i);
                if (m && m[1]) {
                    try { filename = decodeURIComponent(m[1]); } catch (_) { filename = m[1]; }
                }

                var blob = await res.blob();
                var blobUrl = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = blobUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                setTimeout(function () { URL.revokeObjectURL(blobUrl); }, 1000);
            } catch (err) {
                console.error('Download fallito:', err);
                window.open(url, '_blank');
            }
        });
    });

    