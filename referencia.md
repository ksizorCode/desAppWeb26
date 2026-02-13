# Glosario de terminos

## 🧩 Etiqueta (Tag) – Usado en HTML / XML

- **etiqueta**: Define un elemento dentro de una estructura.
- **atributo**: Propiedad que modifica o agrega información a la etiqueta.
- **valor**: Información asignada al atributo.
- **contenido**: Lo que está dentro del elemento.

```html
<etiqueta atributo="valor">contenido</etiqueta>
```

```html
<a href="https://ejemplo.com">Ir al sitio</a>
```
- a = etiqueta
- href = atributo
- https://ejemplo.com = valor
- Ir al sitio = contenido




## 📦 Variable
👉 Sirve para guardar información que puede cambiar durante el programa.

- Variable: Espacio en memoria donde se guarda información.
- $clave: Nombre de la variable.
- “valor”: Dato almacenado dentro de la variable.


```php
$clave = "valor";
```

## ⚙️ Módulo / Función
👉 Las funciones permiten organizar y reutilizar código.

- function: Palabra que define una función.
- funcion: Nombre del bloque reutilizable de código.
- parametros: Datos que la función recibe.
- return: Devuelve un resultado (opcional).


```php
// declaración de la función
function miFuncion($parametros){

    // Código o instrucciones que ejecuta la función
    return resultado;

}
```

- Ejecuta la función.
- Atributos: Valores reales que se envían a la función.


🧱 Parámetro vs Argumento
- Parámetro: Variable que recibe datos dentro de la función.
- Argumento: Valor real que se envía al llamar la función.

```php
  function saludar($nombre) {  // 'nombre' es el parámetro
       return "Hola $nombre";
   
   
   echo saludar("Ana");  // "Ana" es el argumento
```

--