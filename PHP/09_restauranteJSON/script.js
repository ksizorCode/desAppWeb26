const botones = document.querySelectorAll('#vistaControles button');
const categorias = document.querySelectorAll('.categoria');

botones.forEach(btn => {
    btn.addEventListener('click', () => {
        const vista = btn.dataset.vista;

        categorias.forEach(cat => {
            // eliminar todas las clases de vista
            cat.classList.remove('lista','grid', 'compacta');
            // añadir la clase de vista
            cat.classList.add(vista);
        });
    });
});
