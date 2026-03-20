</main>
    <footer>
        <p>&copy; <? echo date('Y')?> Restaurante</p>
    </footer>






<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-contenido">
        <span class="cerrar">&times;</span>
        <h2 id="modal-titulo"></h2>
        <p><strong>Ingredientes:</strong> <span id="modal-ingredientes"></span></p>
        <p><strong>Precio:</strong> <span id="modal-precio"></span></p>
    </div>
</div>

<style>
    /* Estilos del fondo oscuro del modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
        perspective: 1000px; /* Profundidad 3D */
    }

    /* Contenedor del contenido modal */
    .modal-contenido {
        background-color: white;
        margin: 10% auto;
        padding: 20px;
        width: 50%;
        border-radius: 8px;
        text-align: center;
        position: relative;
        transform-style: preserve-3d;
        transform: rotateY(90deg) scale(0.8) translateY(20px);
        opacity: 0;
        transition: transform .3s ease-out, opacity 0.1s ease-out;
    }

    /* Cuando el modal está activo */
    .modal.activo .modal-contenido {
        transform: rotateY(0deg) scale(1)  translateY(0px);;
        opacity: 1;
    }

    /* Botón de cerrar */
    .cerrar {
        float: right;
        font-size: 24px;
        cursor: pointer;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let platos = document.querySelectorAll(".plato");
    let modal = document.getElementById("modal");
    let modalContenido = modal.querySelector(".modal-contenido");
    let modalTitulo = document.getElementById("modal-titulo");
    let modalIngredientes = document.getElementById("modal-ingredientes");
    let modalPrecio = document.getElementById("modal-precio");
    let cerrar = document.querySelector(".cerrar");

    platos.forEach(plato => {
        plato.addEventListener("click", function () {
            modalTitulo.textContent = this.dataset.nombre;
            modalIngredientes.textContent = this.dataset.ingredientes;
            modalPrecio.textContent = this.dataset.precio;

            modal.style.display = "block";

            // Pequeño retraso para que la animación se vea bien
            setTimeout(() => {
                modal.classList.add("activo");
            }, 50);
        });
    });

    cerrar.addEventListener("click", function () {
        modal.classList.remove("activo");

        // Esperamos la animación antes de ocultar el modal
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
    });

    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.remove("activo");
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }
    });
});
</script>












</body>
</html>