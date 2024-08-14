const form = document.getElementById('form');
const result = document.getElementById('result');
const spinner = document.getElementById('spinner');
const button = document.getElementById('button')

        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const object = Object.fromEntries(formData);
            const json = JSON.stringify(object);
            spinner.classList.remove('d-none');
            button.classList.add('d-none');

        
        
            fetch('https://api.web3forms.com/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: json
                })
                .then(async (response) => {
                    let json = await response.json();
                    if (response.status == 200) {
                        setTimeout(() => {
                            result.classList.remove("d-none");
                        }, 2500);
                    } else {
                        console.log(response);
                        result.innerHTML = json.message;
                    }
                })
                .catch(error => {
                    console.log(error);
                    result.innerHTML = "Something went wrong!";
                })
                .then(function() {
                    setTimeout(() => {
                        spinner.style.display = "none";
                    }, 2500);
                    form.reset();
                });
        });