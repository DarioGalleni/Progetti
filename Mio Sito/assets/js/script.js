 // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            mobileMenu.classList.toggle('hidden');
            this.setAttribute('aria-expanded', !isExpanded);
        });

        // WhatsApp integration
        document.getElementById('whatsapp-btn').addEventListener('click', function() {
            const name = document.getElementById('whatsapp-name').value;
            const message = document.getElementById('whatsapp-message').value;
            const phoneNumber = '393298047791';
            
            let whatsappText = `Ciao Dario!`;
            if (name) whatsappText += `\nSono ${name}.`;
            if (message) whatsappText += `\n\n${message}`;
            
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappText)}`;
            window.open(whatsappUrl, '_blank');
        });

        // Back to top functionality
        const backToTopBtn = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.add('opacity-0', 'invisible');
                backToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerHeight = 80; // Account for fixed header
                    const targetPosition = target.offsetTop - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        }

        // Form validation
        const contactForm = document.querySelector('form[action*="web3forms"]');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const message = document.getElementById('message').value.trim();
                
                if (!name || !email || !message) {
                    e.preventDefault();
                    alert('Per favore, compila tutti i campi obbligatori.');
                    return false;
                }
                
                // Basic email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Per favore, inserisci un indirizzo email valido.');
                    return false;
                }
            });
        }
    // Gestore form WhatsApp
    const whatsappButton = document.querySelector('a[href="#"][aria-label*="WhatsApp"], a[href="#"]:has(i.fa-whatsapp)');

    if (whatsappButton) {
        whatsappButton.addEventListener("click", function(event) {
            event.preventDefault();

            const message = document.getElementById("whatsapp-message").value.trim();
            const name = document.getElementById("whatsapp-name").value.trim();

            // Validazione
            if (!name) {
                alert("Per favore inserisci il tuo nome");
                document.getElementById("whatsapp-name").focus();
                return;
            }

            if (!message) {
                alert("Per favore inserisci un messaggio");
                document.getElementById("whatsapp-message").focus();
                return;
            }

            let fullMessage = `Nome: ${name}%0A%0AMessaggio: ${message}`;
            const whatsappURL = `https://wa.me/393298047791?text=${fullMessage}`;

            window.open(whatsappURL, '_blank');

            // Svuota il form dopo l'invio
            document.getElementById("whatsapp-message").value = "";
            document.getElementById("whatsapp-name").value = "";

            // Facoltativo: mostra messaggio di successo
            alert("Messaggio inviato! Ti reindirizzerò su WhatsApp.");
        });
    }