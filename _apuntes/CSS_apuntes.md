# Apuntes de CSS

Bienvenido a los apuntes de CSS. Aquí encontrarás información esencial para aprender y trabajar con hojas de estilo en cascada (CSS).

## Índice

1. [Introducción a CSS](#introducción-a-css)
2. [Selectores](#selectores)
3. [Propiedades Básicas](#propiedades-básicas)
4. [Modelo de Caja](#modelo-de-caja)
5. [Flexbox y Grid](#flexbox-y-grid)
6. [Animaciones y Transiciones](#animaciones-y-transiciones)
7. [Consultas Avanzadas](#consultas-avanzadas)

---

## Introducción a CSS

CSS (Cascading Style Sheets) es un lenguaje de estilos utilizado para diseñar páginas web.

- **Incluir CSS en HTML:**
  ```html
  <link rel="stylesheet" href="styles.css">
  ```
- **Regla CSS básica:**
  ```css
  body {
      background-color: lightblue;
  }
  ```

---

## Selectores

| Selector | Descripción | Ejemplo |
|----------|------------|---------|
| `*` | Selecciona todos los elementos | `* { margin: 0; }` |
| `elemento` | Selecciona todos los elementos de un tipo específico | `p { color: red; }` |
| `.clase` | Selecciona todos los elementos con la clase especificada | `.destacado { font-weight: bold; }` |
| `#id` | Selecciona un elemento con el ID especificado | `#titulo { font-size: 20px; }` |
| `[atributo]` | Selecciona elementos con un atributo específico | `input[type="text"] { border: 1px solid; }` |
| `[atributo="valor"]` | Selecciona elementos con un atributo con un valor específico | `input[type="password"] { background-color: lightgray; }` |
| `[atributo^="valor"]` | Selecciona elementos cuyo atributo comienza con un valor | `a[href^="https"] { color: green; }` |
| `[atributo$="valor"]` | Selecciona elementos cuyo atributo termina con un valor | `img[src$=".png"] { border: none; }` |
| `[atributo*="valor"]` | Selecciona elementos cuyo atributo contiene un valor específico | `div[class*="box"] { padding: 10px; }` |
| `elemento1, elemento2` | Selecciona múltiples elementos | `h1, h2 { color: blue; }` |
| `elemento1 elemento2` | Selecciona elementos dentro de otro elemento | `div p { font-size: 14px; }` |
| `elemento1 > elemento2` | Selecciona elementos hijos directos de otro elemento | `ul > li { list-style: square; }` |
| `elemento1 + elemento2` | Selecciona el primer elemento que sigue inmediatamente a otro | `h1 + p { margin-top: 10px; }` |
| `elemento1 ~ elemento2` | Selecciona todos los elementos que siguen a otro | `h1 ~ p { color: gray; }` |
| `:hover` | Aplica estilos cuando el usuario pasa el mouse sobre un elemento | `button:hover { background-color: yellow; }` |
| `:nth-child(n)` | Selecciona el enésimo hijo de un elemento | `tr:nth-child(even) { background-color: lightgray; }` |
| `:first-child` | Selecciona el primer hijo de un elemento | `p:first-child { font-weight: bold; }` |
| `:last-child` | Selecciona el último hijo de un elemento | `p:last-child { font-style: italic; }` |
| `:not(selector)` | Excluye elementos que coinciden con el selector | `p:not(.importante) { color: gray; }` |

---

## Propiedades Básicas

| Propiedad | Descripción | Ejemplo |
|-----------|------------|---------|
| `color` | Color del texto | `color: blue;` |
| `background-color` | Color de fondo | `background-color: yellow;` |
| `font-size` | Tamaño de fuente | `font-size: 16px;` |
| `margin` | Margen exterior | `margin: 10px;` |
| `padding` | Relleno interior | `padding: 5px;` |

---

## Modelo de Caja

```css
div {
    width: 200px;
    height: 100px;
    padding: 10px;
    margin: 20px;
    border: 2px solid black;
}
```

---

## Flexbox y Grid

### Flexbox
```css
.container {
    display: flex;
    justify-content: center;
    align-items: center;
}
```

### Grid
```css
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
```

---

## Animaciones y Transiciones

### Transición
```css
button {
    transition: background-color 0.3s ease;
}
```

### Animación
```css
@keyframes mover {
    from { transform: translateX(0); }
    to { transform: translateX(100px); }
}

div {
    animation: mover 2s infinite alternate;
}
```

---

## Consultas Avanzadas

### Media Queries
```css
@media (max-width: 600px) {
    body {
        background-color: lightgray;
    }
}
```

### Variables CSS
```css
:root {
    --color-principal: #ff5733;
}

h1 {
    color: var(--color-principal);
}
```

---

## 🚀 Contribuciones

Si quieres contribuir, ¡envía un pull request!

## 📜 Licencia

Este documento está bajo la licencia MIT.
