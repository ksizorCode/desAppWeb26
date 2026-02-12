fetch('frutas.json')
    .then(res => res.json())
    .then(data => {

        const tbody = document.querySelector('#tablaFrutas tbody');

        data.frutas.forEach(fruta => {
            tbody.innerHTML += `
                <tr>
                    <td>${fruta.icono}</td>
                    <td>${fruta.nombre}</td>
                    <td>${fruta.color}</td>
                    <td>${fruta.precio} €</td>
                </tr>
            `;
        });

    })
    .catch(error => console.error('Error:', error));
