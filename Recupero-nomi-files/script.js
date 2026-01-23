const MSG_ERRORE = "Accesso al codice sorgente non consentito.";

// Disabilita tasto destro
document.addEventListener('contextmenu', function (e) {
  e.preventDefault();
  alert(MSG_ERRORE);
});

// Disabilita scorciatoie tastiera per ispezione
document.addEventListener('keydown', function (e) {
  // F12
  if (e.key === 'F12') {
    e.preventDefault();
    alert(MSG_ERRORE);
  }
  // Ctrl+Shift+I (Ispeziona), Ctrl+Shift+J (Console), Ctrl+U (Visualizza Sorgente)
  if ((e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || (e.ctrlKey && e.key === 'u') || (e.ctrlKey && e.key === 'U')) {
    e.preventDefault();
    alert(MSG_ERRORE);
  }
});

const fileInput = document.getElementById('fileInput');
const outputContainer = document.getElementById('outputContainer');
const outputDiv = document.getElementById('output');
const statsDiv = document.getElementById('stats');
const copyBtn = document.getElementById('copyBtn');

function processFiles() {
  if (!fileInput.files.length) return;

  // reset UI
  outputContainer.classList.remove('active');

  setTimeout(() => {
    if ('webkitdirectory' in fileInput) {
      const files = Array.from(fileInput.files);

      if (files.length > 0) {
        // Filter out hidden files or system files if necessary, keeping it raw for now as requested.
        // Create the formatted string: ['name1', 'name2', ...]
        const fileNames = files.map(file => `'${file.name}'`);
        const formattedOutput = `[${fileNames.join(', ')}]`;

        outputDiv.textContent = formattedOutput;
        statsDiv.textContent = `Trovati ${files.length} file.`;
        outputContainer.classList.add('active');
      } else {
        outputDiv.textContent = 'Nessun file trovato nella cartella.';
        statsDiv.textContent = '';
        outputContainer.classList.add('active');
      }
    } else {
      outputDiv.textContent = 'Il tuo browser non supporta la lettura delle directory.';
      outputContainer.classList.add('active');
    }
  }, 100); // Small delay for smooth transition
}

function copyToClipboard() {
  const textToCopy = outputDiv.textContent;
  navigator.clipboard.writeText(textToCopy).then(() => {
    const originalIcon = copyBtn.innerHTML;
    copyBtn.innerHTML = '<i class="bi bi-check-lg"></i>'; // Check icon
    copyBtn.classList.add('btn-success');

    setTimeout(() => {
      copyBtn.innerHTML = '<i class="bi bi-clipboard"></i>'; // Revert icon
      copyBtn.classList.remove('btn-success');
    }, 2000);
  }).catch(err => {
    console.error('Errore durante la copia:', err);
    alert('Impossibile copiare il testo automatically.');
  });
}

fileInput.addEventListener('change', processFiles);
copyBtn.addEventListener('click', copyToClipboard);

// Drag and drop visual feedback
const dropZone = document.getElementById('dropZone');

['dragenter', 'dragover'].forEach(eventName => {
  dropZone.addEventListener(eventName, (e) => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--primary-color)';
    dropZone.style.background = 'rgba(255, 255, 255, 0.05)';
  }, false);
});

['dragleave', 'drop'].forEach(eventName => {
  dropZone.addEventListener(eventName, (e) => {
    e.preventDefault();
    dropZone.style.borderColor = ''; // Revert to CSS hover/default
    dropZone.style.background = '';
  }, false);
});


