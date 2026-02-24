Utilizando esta base del nuestro mini-CRM (Content Management System):

1. Clona el fragmento del respositorio a tu servidor local y crea una web personalizada partiendo de estos cimientos.

2.  Respeta la estructura principal del CRM:
- a. **data.json** para los datos que se repitan
	-**site**: para los datos generales del sitio
(titulo, descripcion, telefono, correo, redes sociales, etc..)
	- **array**: para listas de valores con los que interactural (productos, alumnos, personajes, peliculas, servicios, lugares, videos, galería, animales, plantas, planetas, etc..)
- b. **config.php** para constantes que tengan que ver con la configuración del site/app (en esta fase casi no haría falta tocar nada selvo DEBUG)
	
- c. **views**/ para los apartados o vistas (home.php, servicos.php, contacto.php, etc...)
    
- d. **style.css** para la apariencia de todo el site/app 




## Funciones

titulo(); 
define el titulo del apartado.
si en view/apartado.php exista una variable $titulo con un texto. Añade ese texto como descripcion
@variable $titulo en view/apartad.php 

appTitulo()
define el titulo de la app o site completo
lo obtiene gracias a funcions.php de data.json

description()
si en view/apartado.php exista una variable $descripcion con un texto. Añade ese texto como descripcion
@variable $titulo en view/apartad.php 
