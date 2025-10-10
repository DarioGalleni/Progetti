            // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

let successMessages = document.getElementsByClassName('success');
if (successMessages.length > 0) {
    let successMessageElement = successMessages[0]; 
        setTimeout(() => {
        successMessageElement.style.display = 'none'; 
    }, 3000);
}