/* =========================================
   1. MAIN INITIALIZATION
   ========================================= */
document.addEventListener('DOMContentLoaded', function () {
    initWelcomeModal();
});

/* =========================================
   2. WELCOME MODAL
   ========================================= */
/**
 * Inizializza e mostra la modale di benvenuto se presente nel DOM.
 */
function initWelcomeModal() {
    var modalElement = document.getElementById('welcomeModal');
    if (modalElement && window.bootstrap) {
        var welcomeModal = new bootstrap.Modal(modalElement);
        welcomeModal.show();
    }
}
