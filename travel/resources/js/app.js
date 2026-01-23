import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './script.js';

// Importa Bootstrap per i side-effects (inizializzazione data-attributes)
import 'bootstrap';

// Espone l'oggetto bootstrap globalmente
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
