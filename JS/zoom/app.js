

document.querySelector('#zoom').addEventListener('mousemove', calcularPos);
document.querySelector('#zoom').addEventListener('mouseout', reseteoPos);

// Añadir el listener para el evento mouseover
document.querySelector('#zoom').addEventListener('mouseover', calcularPos);

// Función para calcular la posición del mouse
function calcularPos(event) {
    // Obtener posición del mouse directamente del evento
    const posX = event.clientX;
    const posY = event.clientY;

    // Mostrar posición en el elemento con id 'info'
    document.querySelector('#info').innerHTML = `X: ${posX}, Y: ${posY}`;

    //mover la imagen
    document.querySelector('#zoom img').style.left= (posX*-8)+'px';
    document.querySelector('#zoom img').style.top= (posY*-6)+'px';

}

function reseteoPos() {
    document.querySelector('#zoom img').style.left= '0px';
    document.querySelector('#zoom img').style.top= '0px';
}

