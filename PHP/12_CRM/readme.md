# Mini-CMS
Content Managment System es...

El siguiente modelo tiene esta estructura:
```
/mini-cms
│
├── index.php              ← Router principal (?page=)
├── functions.php          ← Funciones comunes
├── config.php             ← Constantes de configuración de la App/Site
│
├── /inc
│   ├── header.php         ← <head>, <header>, navegación y apertura del <HTML>
│   └── footer.php         ← <footer>, scripts y cierre del </HTML>
│
├── /views                 ← Vistas (contenido)
│   ├── home.php
│   ├── servicios.php
│   ├── apartados.php
│   ├── ... .php
│   ├── ... .php
│   └── contacto.php
│
└── /assets
    ├── /css
    │   └── style.css
    ├── /js
    │   └── app.js
    └── /img

```

De tal forma que separaremos los Datos, Funcionalidades, Apariencia de la siguiente manera:

1. Datos y contenido 
   - data.json contiene los datos generales como título, descripción descripción general, y otros datos que se repetirían como teléfono, dirección, email, lista de redes sociales, etc.
   - view / home.php contiene lo referente al contenido de la página de inicio
   - view / contacto.php ejemplo de otro apartado que contiene los elementos para contacto.php
   - view / apartado.php ejemplo de otro posible apartado
   Para todos estos apartados hay que cargar index.php y pasarle como parametro GET un valor a través de "pages":
   index.php?pages=home -> cargará home.php en el main del index, actualizando title, h1.
   
2. Funcionalidades.
	Estarán almacenados en el archivo funcions.php. Más abajo se describirán muchas de ellas para que se tenga en cuenta su uso.

3. Apariencia
	Estará contenida en diferentes elementos:
	- style.css será el estilo principal que se encargará del css
	- inc / header.php se encargará de la apertura del html y header
	- inc / footer.php se encargará del footer y cierre de html

---

## Funciones
```php titulo();``` 
escribe el titulo del apartado.
si en view/apartado.php exista una variable $titulo con un texto. Añade ese texto como descripcion
@variable $titulo en view/apartad.php 

```php appTitulo();```
define el titulo de la app o site completo
lo obtiene gracias a funcions.php de data.json
almacenando los datos de data.json en un array $data. Finamente la función accede a $data['site']['title']

```php phpappTitulo();```
description();```
si en view/apartado.php exista una variable $descripcion con un texto. Añade ese texto como descripcion
la función accede a $data['site']['description']
@variable $titulo en view/apartad.php 

---