document.getElementById('dataForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const cognome = document.getElementById('cognome').value;
    const age = document.getElementById('age').value;

    console.log(name,cognome,age)

    const data = {
        name: name,
        cognome: cognome,
        age: age,
    };

    fetch('https://https://papaya-smakager-ebd02f.netlify.app/api', {  // Sostituisci con il tuo URL API
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        document.getElementById('response').innerText = 'Risposta del server: ' + JSON.stringify(data);
    })
    .catch((error) => {
        console.error('Error:', error);
        document.getElementById('response').innerText = 'Errore: ' + error;
    });
});
