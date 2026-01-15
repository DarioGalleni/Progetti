document.addEventListener('DOMContentLoaded', function () {
	/* ==========================
	   Modulo: Tema (modalità notte)
	   ========================== */
	function initThemeModule() {
		const enableButton = document.getElementById('enable-night-mode');
		const disableButton = document.getElementById('disable-night-mode');
		const body = document.body;

		// Anima le icone del tema quando si alterna la modalità notte; clsIn=true => animazione-in, false => animazione-out
		function animateIcon(el, clsIn) {
			if (!el) return;
			el.classList.remove('anim-in', 'anim-out');
			// Forza il reflow per riavviare l'animazione
			void el.offsetWidth;
			el.classList.add(clsIn ? 'anim-in' : 'anim-out');
		}

		// Applica o rimuove gli stili della modalità notte e salva la preferenza in localStorage
		function applyNightMode(enabled) {
			const enableIcon = enableButton?.querySelector('.theme-icon');
			const disableIcon = disableButton?.querySelector('.theme-icon');

			if (enabled) {
				body.classList.add('night-mode');
				localStorage.setItem('nightMode', 'enabled');
				enableButton?.classList.add('hidden');
				disableButton?.classList.remove('hidden');
				animateIcon(disableIcon, true);
				animateIcon(enableIcon, false);
			} else {
				body.classList.remove('night-mode');
				localStorage.setItem('nightMode', 'disabled');
				enableButton?.classList.remove('hidden');
				disableButton?.classList.add('hidden');
				animateIcon(enableIcon, true);
				animateIcon(disableIcon, false);
			}
		}

		// Inizializza l'interfaccia in base alla preferenza di modalità notte salvata
		const stored = localStorage.getItem('nightMode');
		applyNightMode(stored === 'enabled');

		// Collega i gestori di click ai pulsanti di cambio tema
		if (enableButton) enableButton.addEventListener('click', () => applyNightMode(true));
		if (disableButton) disableButton.addEventListener('click', () => applyNightMode(false));
	}

	/* ==========================
	   Modulo: Calendario drag & helpers
	   ========================== */
	function initCalendarDragModule() {
		const calendarContainer = document.getElementById('calendar-container');
		if (!calendarContainer) return;

		// classi iniziali
		calendarContainer.classList.add('drag-scroll');

		let isPointerDown = false;
		let isDragging = false;
		let startX = 0, startY = 0;
		let scrollLeft = 0, scrollTop = 0;
		const DRAG_THRESHOLD = 4;

		// Avvia il trascinamento per lo scorrimento del calendario
		calendarContainer.addEventListener('mousedown', (e) => {
			isPointerDown = true;
			isDragging = false;
			startX = e.pageX;
			startY = e.pageY;
			scrollLeft = calendarContainer.scrollLeft;
			scrollTop = calendarContainer.scrollTop;
		});

		// Termina il trascinamento
		window.addEventListener('mouseup', () => {
			if (!isPointerDown) return;
			isPointerDown = false;
			calendarContainer.classList.remove('dragging');
			setTimeout(() => { isDragging = false; }, 0);
		});

		// Aggiorna la posizione di scorrimento durante il trascinamento
		window.addEventListener('mousemove', (e) => {
			if (!isPointerDown) return;
			const dx = e.pageX - startX;
			const dy = e.pageY - startY;
			if (!isDragging && Math.hypot(dx, dy) > DRAG_THRESHOLD) {
				isDragging = true;
				calendarContainer.classList.add('dragging');
			}
			if (isDragging) {
				e.preventDefault();
				calendarContainer.scrollLeft = scrollLeft - dx;
				calendarContainer.scrollTop = scrollTop - dy;
			}
		});

		// Previene i click accidentali durante il trascinamento
		calendarContainer.addEventListener('click', (e) => {
			if (isDragging) {
				e.preventDefault();
				e.stopPropagation();
			}
		}, true);

		// All'avvio, scorre il calendario per mostrare la colonna di oggi se presente
		window.addEventListener('load', function () {
			const todayCol = document.getElementById('today');
			if (todayCol) calendarContainer.scrollLeft = todayCol.offsetLeft;
		});

		// Centra la cella di oggi nel calendario
		function centerToday() {
			const todayCell = document.querySelector('.today-cell');
			if (todayCell) {
				const containerWidth = calendarContainer.offsetWidth;
				const cellWidth = todayCell.offsetWidth;
				const cellLeft = todayCell.offsetLeft;
				const scrollTo = cellLeft - (containerWidth / 2) + (cellWidth / 2);
				calendarContainer.scrollLeft = scrollTo;
			}
		}

		// Chiama la funzione al caricamento della pagina e quando il calendario è visibile
		window.addEventListener('load', centerToday);
		window.addEventListener('resize', centerToday);
	}

	/* ==========================
	   Modulo: Modale Ambiente di Test
	   ========================== */
	function initTestEnvironmentModal() {
		const testModal = document.getElementById('testEnvironmentModal');
		if (testModal && typeof bootstrap !== 'undefined') {
			const modal = new bootstrap.Modal(testModal);
			modal.show();
		}
	}

	/* ==========================
	   Inizializzazione moduli
	   ========================== */
	initThemeModule();
	initCalendarDragModule();
	initTestEnvironmentModal();
});