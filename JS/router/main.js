const cache = new Map(); // Almacena las páginas ya cargadas

const loadPage = async (url) => {
    const app = document.getElementById("app");

    // Efecto de salida
    app.classList.remove("fade-in");
    app.classList.add("fade-out");

    // Espera la animación antes de cambiar el contenido
    setTimeout(async () => {
        if (cache.has(url)) {
            app.innerHTML = cache.get(url);
        } else {
            try {
                const response = await fetch(`${url}.html`);
                if (!response.ok) throw new Error("Página no encontrada");
                const content = await response.text();
                cache.set(url, content);
                app.innerHTML = content;
            } catch (error) {
                const response = await fetch(`/404.html`);
                const content = await response.text();
                app.innerHTML = content;
            }
        }

        // Efecto de entrada
        app.classList.remove("fade-out");
        app.classList.add("fade-in");
    }, 300); // Tiempo de animación
};

const navigateTo = (url) => {
    history.pushState(null, null, url);
    loadPage(url);
};

document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", (e) => {
        if (e.target.matches("[data-link]")) {
            e.preventDefault();
            navigateTo(e.target.getAttribute("href"));
        }
    });

    window.addEventListener("popstate", () => {
        loadPage(window.location.pathname);
    });

    loadPage(window.location.pathname);
});
