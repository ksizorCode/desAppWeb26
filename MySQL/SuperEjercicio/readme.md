# 🗄️ Ejercicio con Bases de Datos – WebApp

Crea una **WebApp** que consulte datos en una base de datos y permita **listar, filtrar y mostrar información detallada**. Como ejemplo puedes usar el ejercicio de Arte hecho en clase.

(lo que figura con * es Opcional)

---

## 🎨 Diseño (Colorinchis): Layout y Estructura

- ✅ Limpia y clara
- 🌈 *Diseño UI/UX previo en Figma o similar
- 📱 CSS **responsive**
- 🖼️ *Pase de diapositivas
- 🔤 *Tipografías o fuentes externas (google fonts)

💡 Ideas adicionales:  
- Colores armoniosos y consistentes. 
- Barra de navegación fija y menú hamburguesa en móvil.  
- Feedback visual al interactuar con botones y filtros.  
- Animaciones o aparición de elementos con scroll
---



## ⚡ JS y  Progressive Web Application (PWA)

Aunque se haga en **PHP**, podemos implementar algunos elementos básicos de una PWA:

- 📄 `manifest.json` con nombre, short_name y colores  
- 🖼️ Iconos para diferentes tamaños  
- 🌐 `service-worker.js` básico para cache de ciertos assets  
- 💬 *Notificaciones push simuladas o en tiempo real
- 📡 *Localización + Acelerometro para mostrar lugar y distancia a la que se encuentra un objeto...

💡 Extra: prueba a que la app se “añada a pantalla de inicio” en móvil.  

---

## 🖥️ Programación en PHP

- 📂 Correcta estructura y orden de carpetas
- 🚚 Funciones y constantes reutilizables (funcionts.php y/o config.php)
- ⚙️ Sistema de **Reset o instalación** para la base de datos  
- 📋 Sumario o listado de elementos  
- 🔢 *Paginación para listas largas  
- 📄 Ficha individual del producto o elemento  
- 🔍 *Buscador por nombre, categoría o disciplina  

💡 Ideas extra:  
- Validación de formularios en PHP y JS  
- Código comentado para que sea didáctico  
- Sistema de plantillas para no repetir HTML
- Readme.md explicativo  

---

## 🗃️ Base de Datos

- 🏷️ Tablas de datos principales (solo datos limpios)
- 🔗 Tablas de relación entre elementos 
- 🔍 Posibilidad de consultas con **JOINs**  
- 📊 *Campos tipo: descripción, categorias, tipos, imágenes, fechas, videos Youtube, coordenadas GPS para mapas, etc  

💡 Extra:  
- Llaves foráneas y ON DELETE CASCADE o SET NULL  
- Datos de ejemplo completos y variados  

---

## 🛠️ Opcional

- 🌐 *URLs limpias con `.htaccess`  
- ✏️ *CRUD (Crear, Leer, Actualizar, Eliminar)  
- 🔒 *Acceso a partes sensibles con **usuario y contraseña**  
- 📈 *Gráficos o estadísticas simples de los datos
- 💼 *Exportación de datos o consultas en formato JSON para crear tu propia API
- 🪂 *Consultas a datos o APIs externas  

---

## 💡 Ideas Extra para “brillo” 💡

- 🎯 *Filtros dinámicos con JS (por disciplina, autor, año, etc.)  
- 🖼️ *Miniaturas de imágenes con zoom o ventana modal  
- ⏱️ *Carga de datos con animaciones o skeletons  
- 🏆 *Resaltar elementos destacados (por ejemplo, obras famosas)  
- 📱 *Prueba en varios dispositivos y resoluciones
- 🧰 A*lmacenamiento de datos en localStorage  

---

Suerte! 🚀





---

# Trukitos y cositas que siempre quedan bien:




## Buscador:

```sql
SELECT * FROM obras WHERE nombre LIKE "%cena%"
```


## Paginación
```sql
SELECT *
FROM obras
ORDER BY fecha_creacion DESC
LIMIT 5 OFFSET 5; -- página 2 con 5 registros por página
```

## Filtros dinámicos
Una vez ya se ha mostrado los datos puedes utilizar filtros de JS. Ten en cuenta que esto no conlleva nuevas búsquedas en la base de datos. Solo jugará con los valores que ya tenemos desplegados en local.
https://www.w3schools.com/HOWTO/howto_js_filter_lists.asp
