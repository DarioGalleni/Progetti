    document.addEventListener('DOMContentLoaded', function() {
        
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                mobileMenu.classList.toggle('hidden');
                this.setAttribute('aria-expanded', !isExpanded);
            });
        }

        // WhatsApp integration
        const whatsappBtn = document.getElementById('whatsapp-btn');
        if (whatsappBtn) {
            whatsappBtn.addEventListener('click', function() {
                const nameInput = document.getElementById('whatsapp-name');
                const messageInput = document.getElementById('whatsapp-message');
                
                const name = nameInput ? nameInput.value.trim() : '';
                const message = messageInput ? messageInput.value.trim() : '';
                const phoneNumber = '393298047791';
                
                if (!name) {
                    alert("Per favore inserisci il tuo nome");
                    if(nameInput) nameInput.focus();
                    return;
                }
                
                let whatsappText = `Ciao Dario!`;
                if (name) whatsappText += `\nSono ${name}.`;
                if (message) whatsappText += `\n\n${message}`;
                
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappText)}`;
                window.open(whatsappUrl, '_blank');
            });
        }

        // Parallax Effect for Blobs
        document.addEventListener('mousemove', function(e) {
            const blobs = document.querySelectorAll('.blob');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            blobs.forEach((blob, index) => {
                const speed = (index + 1) * 20; // Different speed for each blob
                const xOffset = (window.innerWidth / 2 - e.clientX) / speed;
                const yOffset = (window.innerHeight / 2 - e.clientY) / speed;
                
                blob.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
            });
        });

        // Back to top functionality
        const backToTopBtn = document.getElementById('back-to-top');
        if (backToTopBtn) {
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
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    const headerHeight = 80; // Account for fixed header
                    const targetPosition = target.offsetTop - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                         mobileMenu.classList.add('hidden');
                         if(menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });
        }

        // Contact Form Validation
        const contactForm = document.querySelector('form[action*="web3forms"]');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                const message = document.getElementById('message').value.trim();
                
                if (!name || !message) {
                    e.preventDefault();
                    alert('Per favore, compila tutti i campi obbligatori.');
                    return false;
                }
            });
        }

        // Animated Counter
        const animateCounter = (element, target, duration = 2000) => {
            let current = 0;
            const increment = target / (duration / 16); // 60fps
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = Math.ceil(target);
                    clearInterval(timer);
                } else {
                    element.textContent = Math.ceil(current);
                }
            }, 16);
        };

        // Observer for Counter Animation
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    animateCounter(entry.target, target);
                    entry.target.classList.add('counted');
                }
            });
        }, { threshold: 0.5 });

        // Observe all counters
        document.querySelectorAll('.counter').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Add parallax effect on scroll
        let scrollPosition = 0;
        window.addEventListener('scroll', () => {
            scrollPosition = window.scrollY;
            document.documentElement.style.setProperty('--scroll', scrollPosition);
        });

        // Add shimmer effect on hover to cards
        const addShimmerToCards = () => {
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.overflow = 'hidden';
                });
            });
        };
        addShimmerToCards();

        // Typing effect for hero text (optional enhancement)
        const addTypingEffect = () => {
            const typingElements = document.querySelectorAll('[data-typing]');
            typingElements.forEach(element => {
                const text = element.textContent;
                element.textContent = '';
                element.style.opacity = '1';
                
                let i = 0;
                const typeWriter = () => {
                    if (i < text.length) {
                        element.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 100);
                    }
                };
                typeWriter();
            });
        };

        // Stagger animation for tech icons
        const staggerTechIcons = () => {
            const techIcons = document.querySelectorAll('[data-aos="flip-left"]');
            techIcons.forEach((icon, index) => {
                setTimeout(() => {
                    icon.classList.add('aos-animate');
                }, index * 100);
            });
        };

        // Add magnetic effect to CTA buttons
        const magneticButtons = document.querySelectorAll('.tilt-hover');
        magneticButtons.forEach(button => {
            button.addEventListener('mousemove', (e) => {
                const rect = button.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                button.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px) perspective(1000px) rotateX(${-y * 0.05}deg) rotateY(${x * 0.05}deg) scale(1.02)`;
            });
            
            button.addEventListener('mouseleave', () => {
                button.style.transform = '';
            });
        });

        // Lazy load improvements
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    });