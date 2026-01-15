document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const num1El = document.getElementById('num1');
    const num2El = document.getElementById('num2');
    const inputEl = document.getElementById('input');
    const buttonEl = document.getElementById('button');
    const messageEl = document.getElementById('message');
    const captchaBox = document.querySelector('.captcha-box');

    // State
    let num1, num2;

    // Initialize
    initGame();

    // Event Listeners
    buttonEl.addEventListener('click', checkAnswer);

    inputEl.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            checkAnswer();
        }
    });

    // Functions
    function initGame() {
        generateNumbers();
        resetUI();
    }

    function generateNumbers() {
        num1 = Math.floor(Math.random() * 10);
        num2 = Math.floor(Math.random() * 10);

        // Update DOM
        num1El.textContent = num1;
        num2El.textContent = num2;
    }

    function resetUI() {
        inputEl.value = '';
        messageEl.className = 'message';
        messageEl.textContent = '';
        inputEl.focus();

        // Reset border colors if changed previously
        inputEl.style.borderColor = '';
        captchaBox.style.borderColor = '';
    }

    function checkAnswer() {
        const value = inputEl.value.trim();

        // Validation
        if (value === '') {
            showMessage('Inserisci un numero per continuare', 'error');
            inputEl.focus();
            shakeElement(captchaBox);
            return;
        }

        const userAnswer = Number(value);
        const correctSum = num1 + num2;

        if (userAnswer === correctSum) {
            handleSuccess();
        } else {
            handleError();
        }
    }

    function handleSuccess() {
        showMessage('Verifica completata con successo!', 'success');
        inputEl.style.borderColor = 'var(--success-color)';
        captchaBox.style.borderColor = 'var(--success-color)';

        buttonEl.innerHTML = 'Reindirizzamento...';
        buttonEl.style.backgroundColor = 'var(--success-color)';
        buttonEl.disabled = true;

        // Redirect to success page after a short delay
        setTimeout(() => {
            window.location.href = 'success.html';
        }, 1000);
    }

    function handleError() {
        showMessage('Risposta errata, riprova.', 'error');
        inputEl.style.borderColor = 'var(--error-color)';
        shakeElement(captchaBox);
        inputEl.value = '';
        inputEl.focus();
    }

    function showMessage(text, type) {
        messageEl.textContent = text;
        messageEl.className = `message show ${type}`;
    }

    function shakeElement(element) {
        element.classList.remove('shake');
        // Force reflow
        void element.offsetWidth;
        element.classList.add('shake');
    }
});
