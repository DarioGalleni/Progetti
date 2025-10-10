import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Inizializza i tooltip di Bootstrap (assicurarsi di ricompilare gli asset: npm run dev/build)
document.addEventListener('DOMContentLoaded', function () {
	if (typeof bootstrap !== 'undefined') {
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
		tooltipTriggerList.forEach(function (el) { new bootstrap.Tooltip(el); });
	}
});
