
# Apuntes de JavaScript

Bienvenido a los apuntes de JavaScript. Aquí encontrarás información esencial para aprender y trabajar con este lenguaje de programación.

## Índice

1. [Introducción a JavaScript](#introducción-a-javascript)
2. [Variables y Tipos de Datos](#variables-y-tipos-de-datos)
3. [Operadores](#operadores)
4. [Estructuras de Control](#estructuras-de-control)
5. [Funciones](#funciones)
6. [Manipulación del DOM](#manipulación-del-dom)
7. [Consultas Avanzadas](#consultas-avanzadas)

---

## Introducción a JavaScript

JavaScript es un lenguaje de programación utilizado principalmente para el desarrollo web.

- **Ejecutar código en la consola del navegador:**
  ```js
  console.log("¡Hola, mundo!");
  ```
- **Incluir JavaScript en HTML:**
  ```html
  <script src="script.js"></script>
  ```

---

## Variables y Tipos de Datos

| Tipo | Descripción | Ejemplo | Tipado Estricto |
|------|------------|---------|----------------|
| `string` | Texto | `let nombre = "Juan";` | `let nombre: string = "Juan";` |
| `number` | Número | `let edad = 25;` | `let edad: number = 25;` |
| `boolean` | Booleano | `let activo = true;` | `let activo: boolean = true;` |
| `array` | Arreglo | `let colores = ["rojo", "azul"];` | `let colores: string[] = ["rojo", "azul"];` |
| `object` | Objeto | `let persona = { nombre: "Juan" };` | `let persona: { nombre: string } = { nombre: "Juan" };` |

---

## Operadores

| Tipo | Operadores |
|------|------------|
| Aritméticos | `+`, `-`, `*`, `/`, `%` |
| Comparación | `==`, `!=`, `===`, `!==`, `>`, `<` |
| Lógicos | `&&`, `||`, `!` |
| Asignación | `=`, `+=`, `-=`, `*=`, `/=` |

---

## Estructuras de Control

### Condicionales
```js
if (edad >= 18) {
    console.log("Eres mayor de edad.");
} else {
    console.log("Eres menor de edad.");
}
```

### Bucles
```js
for (let i = 0; i < 5; i++) {
    console.log(`Número: ${i}`);
}
```

---

## Funciones

```js
function saludar(nombre) {
    return `Hola, ${nombre}`;
}

console.log(saludar("Carlos"));
```

---

## Manipulación del DOM

### Seleccionar Elementos
```js
document.getElementById("miElemento");
document.querySelector(".clase");
```

### Modificar Contenido
```js
document.getElementById("titulo").textContent = "Nuevo Título";
```

### Agregar Eventos
```js
document.getElementById("boton").addEventListener("click", function() {
    alert("Botón presionado");
});
```

---

## Consultas Avanzadas

### Fetch API para obtener datos
```js
fetch("https://api.example.com/datos")
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error("Error:", error));
```

### Promesas
```js
function tareaAsincrona() {
    return new Promise((resolve, reject) => {
        setTimeout(() => resolve("Tarea completada"), 2000);
    });
}

tareaAsincrona().then(console.log);
```

---

## 🚀 Contribuciones

Si quieres contribuir, ¡envía un pull request!

## 📜 Licencia

Este documento está bajo la licencia MIT.
