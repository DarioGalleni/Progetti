document.addEventListener('keydown', function(a) {
if (a.key === 'F12' || (a.ctrlKey && a.shiftKey && a.key === 'I')) {
      a.preventDefault();
      alert("codice nascosto")
  }
});

function leggiNomiFile() {
    const fileInput = document.getElementById('fileInput');
    const outputDiv = document.getElementById('output');

    if ('webkitdirectory' in fileInput) {
      const files = fileInput.files;

      if (files.length > 0) {
        const nomiFile = Array.from(files).map(file => `'${file.name}'`);
        const nomiFileHTML = nomiFile.join(', ');
        outputDiv.innerHTML = `Nomi dei file nella cartella: [${nomiFileHTML}]`;
      } else {
        outputDiv.innerHTML = 'Nessun file selezionato.';
      }
    } else {
      outputDiv.innerHTML = 'Il tuo browser non supporta la lettura delle cartelle.';
    }
  }


  document.getElementById('fileInput').addEventListener('change', leggiNomiFile);

