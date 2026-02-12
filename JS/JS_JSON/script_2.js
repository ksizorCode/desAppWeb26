async function cargarFrutas() {
    try {
        const res = await fetch('frutas.json');
        const data = await res.json();

        const tbody = document.querySelector('#tablaFrutas tbody');

        for (let fruta of data.frutas) {
            tbody.innerHTML += `
                <tr>
                    <td>${fruta.icono}</td>
                    <td>${fruta.nombre}</td>
                    <td>${fruta.color}</td>
                    <td>${fruta.precio} €</td>
                </tr>
            `;
        }

    } catch (err) {
        console.error(err);
    }
}

cargarFrutas();
