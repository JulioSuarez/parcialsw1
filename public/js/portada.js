fetch('/api/usuario')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
