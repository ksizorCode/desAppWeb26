# VUE

## Instalación:

Para que VUE funcione tenemos que instalar node.js
Esto es javascript a nivel de servidor y descargamos la versión msi 

1. https://nodejs.org/en/download

Para revisar si está correctamente instalado abre CMD o PowerShell de Windows y escribe:
```terminal
node -v

// Dará como resultado algo tipo: (indicando al vesión)
v24.14.0

```


## Crear un proyecto
Vamos a hacer un nuevo proyecto con VUE 

1. VSCODE / Terminal / New Terminal

```PowerShell
Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
```

Este comando le da "permiso" a tu computadora para ejecutar scripts de PowerShell que tú mismo hayas escrito o que sean de fuentes confiables.

Por defecto, Windows bloquea la ejecución de archivos .ps1 (scripts) por seguridad. Al ejecutar ese comando (corrigiendo los errores de dedo), estás desbloqueando esa función:

Set-ExecutionPolicy: Es la orden para cambiar la regla de seguridad.

-Scope CurrentUser: Indica que el cambio solo te afecta a ti (tu usuario actual), por lo que no necesitas permisos de Administrador para aplicarlo.

RemoteSigned: Esta es la configuración clave. Permite:

Ejecutar cualquier script que tú crees en tu propia PC.

Ejecutar scripts descargados de internet solo si están firmados por un editor de confianza.



---

☕ Hoja de Ruta: Proyecto Cafetería con Vue.js

Vue.js es ideal para este proyecto por su velocidad y su sistema de componentes basado en archivos .vue. A continuación, los pasos para inicializar la infraestructura de la cafetería digital.

##📋 1. Requisitos Previos

Antes de empezar, asegúrate de tener el entorno de ejecución listo.

- Node.js: Necesario para gestionar paquetes y el servidor de desarrollo.

```
node -v
```

- Permisos de Ejecución: (Solo Windows) Para evitar errores con scripts de terceros.
```
Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
```


## 🚀 2. Creación del Proyecto (Vite)

Utilizaremos Vite, la herramienta oficial recomendada por el equipo de Vue por su extrema rapidez.
```
npm create vue@latest
```

## ⚙️ Configuración recomendada para la cafetería:
Movese con las flechas e intros para avanzar

| Opción             |   Selección       |Razón                                                   |
|---|---|---|
| Project name        | VueCoffe           | Identificador del proyecto.                          |
| Package name        | vuecoffe           | Identificador del proyecto.                          |
| Add TypeScript?     | No / Sí            | No para mayor sencillez, Sí para proyectos grandes.  |
| Add Vue Router?     | Sí                 | Vital para navegar entre Inicio, Menú y Contacto.    |
| Add Pinia?          | Sí                 | Para gestionar el estado del carrito de compras.     |
| Add ESLint/Prettier | Sí                 |Mantener el código limpio y profesional.              |


Nos aparecerá algo así para:
- Acceder a la carpeta del proyecto
- instalar elementos necesarios 
- instalar elementos de desarrollo
```
   cd VueCoffe
   npm install
   npm run dev
```

Cuando todo esté instalado nos saldrá algo parecido a esto de donde podremos acceder a la plataforma:
```
  ➜  Local:   http://localhost:5173/
  ➜  Network: use --host to expose
  ➜  Vue DevTools: Open http://localhost:5173/__devtools__/ as a separate window
  ➜  Vue DevTools: Press Alt(⌥)+Shift(⇧)+D in App to toggle the Vue DevTools
  ➜  press h + enter to show help
```

##  🛠️ 3. Instalación y Arranque

Una vez creada la carpeta del proyecto, sigue esta secuencia de comandos:

# Entrar al directorio
cd cafeteria-chill

# Instalar dependencias
npm install

# Iniciar servidor local
npm run dev


Acceso: Abre http://localhost:5173 en tu navegador para ver la aplicación base.

🏗️ 4. Estructura de Componentes Sugerida

Para una organización profesional, dividiremos la interfaz en piezas modulares dentro de src/components/:

Navbar.vue: Logotipo y navegación.

Hero.vue: Portada visual (imagen de café humeante y título).

ProductCard.vue: Ficha del café (foto, precio, descripción).

MenuGrid.vue: Galería que organiza todas las ProductCard.

Footer.vue: Datos de contacto, horarios y redes sociales.

🎨 5. Estilos y Diseño (Tailwind CSS)

Para agilizar el diseño y obtener ese aspecto "chill" y moderno, instalaremos Tailwind CSS:

npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p


Esto permitirá aplicar clases directamente en el HTML como bg-brown-900 o rounded-xl.

💡 Próximo Hito

Configurar el componente de Menú cargando la lista de productos (Espresso, Latte, Capuchino) para visualizar el catálogo inicial.

