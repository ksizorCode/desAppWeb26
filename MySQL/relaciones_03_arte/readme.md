# Ejercicio

## Comienzo
- Instala en tu ordenador todo el sistema
- Revisa que funciona todo correctamente y que la base de datos tiene contenido

## Experimentando
- Crea alguna obra y artista nuevos y comprueba que se muestran en la plataforma

## Desarrollo de nuevo contenido:
- Vamos a relacionar las tablas entre sí. Genera en Comando SQL la consulta con las relaciones para mostrar el autor de las obras y las disciplinas
- crea en php un archivo nuevo (puedes clonar uno anterior) donde se muestre esta nueva información
- crea un sistema de filtros por Autor o Disciplina


## CRUD
- Desarrolla un mini-CRUD


## Implementa un sustema de usuario y contraseña 
- Para que no puedan entrar roles indevidos en el CRUD o el reseteo



---
# Resolviendo el ejercicio:

-- Atención! - ten en cuenta que en esta versión se ha cambiado el nombre de la tabla "creadores" a autores, así como todas las referencias en MySQL y en el PHP. Revisa posibles errores en este cambio de nombre

creadores -> autores
creador -> autor
obra-creador -> obra-autor
oc -> oa

---

## 01. Testeo para ver si funciona:

```sql
#Testeos básico (jugando con consultas SQL)
SELECT * FROM obras

SELECT * FROM autores

SELECT * FROM disciplinas

SELECT titulo FROM obras LIMIT 3

SELECT nombre, lugar FROM autores ORDER BY lugar DESC
```

## 02. Relación entre Obras y autores
```sql
# Relacion Obra-autor:
SELECT * 
FROM obras
JOIN obras_autores 
    ON obras_autores.obra_id = obras.id
JOIN autores 
    ON obras_autores.autor_id = autores.id;
```
La consulta anterior nos devuelve un montón de datos innecesarios como IDs y otros valores que no nos interesan.

Realación con los datos limpios (con alias)
```sql
SELECT
    o.titulo AS "Título Obra",
    a.nombre AS "Nombre Autor" 
FROM obras o
JOIN obras_autores oc
    ON oa.obra_id = o.id
JOIN autores c
    ON oa.autor_id = a.id;
```


## 03. Relación entre Obra y Disciplina

Relación a lo bruto
```sql
# Relacion Obra-Disciplina:
SELECT * 
FROM obras
JOIN obras_disciplinas
    ON obras_disciplinas.obra_id = obras.id
JOIN disciplinas 
    ON obras_disciplinas.disciplina_id = disciplinas.id;
```
Relación en la que nos devuelve los datos más limpios (con alias):
```sql
SELECT 
    o.titulo AS "Título Obra"
    d.nombre AS "Nombre Disciplina"
FROM obras o
JOIN obras_disciplinas od
    ON od.obra_id = o.id
JOIN disciplinas d
    ON od.disciplina_id = d.id;
```


## 04. Combinación de ambas consultas:


```sql
SELECT 
    o.titulo AS 'Titulo Obra',
    a.nombre AS 'Nombre Autor',
    d.nombre AS 'Disciplina Artística'
FROM obras o

-- Relación con autores
JOIN obras_autores oc 
    ON oa.obra_id = o.id
JOIN autores c 
    ON oa.autor_id = a.id

-- Relación con disciplinas
JOIN obras_disciplinas od 
    ON od.obra_id = o.id
JOIN disciplinas d 
    ON od.disciplina_id = d.id;
```

## 05. Combinación de ambas consultas basadas en una única obra o ID:

Para info.php vamos a capturar el id de la obra, por lo que tendremos que hacer una consulta en la que sólo nos devuelva el valor basado en el ID de la misma.
Vastará con añadir al final del todo `WHERE id = 2` (2 por ejemplo) para que esto funcione.

Por otro lado también también tenemos que preparar los datos en el SELECT que necesitamos que nos devuelva la consulta:
- id de la obra     → `id`
- titulo de la obra → `titulo`
- imagen de la obra → `imagen`
- año de la obra → `año`
- descripción de la obra → `descripcion`
- nombre del autor → `autor`
- nombre de la disciplina → `disciplina`
- id del autor  → `id_autor`
- id de la disciplina  → `id_disciplina`


```sql
SELECT 
    o.id,
    o.titulo,
    o.imagen,
    o.año,
    o.descripcion,
    a.nombre AS 'autor',
    d.nombre AS 'disciplina',
    a.id AS id_autor,
    d.id AS id_disciplina
FROM obras o

-- Relación con autores
JOIN obras_autores oc 
    ON oa.obra_id = o.id
JOIN autores c 
    ON oa.autor_id = a.id

-- Relación con disciplinas
JOIN obras_disciplinas od 
    ON od.obra_id = o.id
JOIN disciplinas d 
    ON od.disciplina_id = d.id

WHERE o.id = 2;

```



```sql
SELECT 
    o.titulo,
    o.imagen,
    o.descripcion,
    a.nombre AS 'autor',
    d.nombre AS 'disciplina'
    ...
```


---
---

## 06. el PHP: info.php

El info.php quedaría así:


```php
<? require 'functions.php'?>
<? getheader();?>

<a href="index.php" class="btn">❮❮ Volver</a>

<?php
$id = $_GET["id"];
$sql = "SELECT 
    o.id,
    o.titulo,
    o.imagen,
    o.año,
    o.descripcion,
    a.nombre AS 'autor',
    d.nombre AS 'disciplina',
    a.id AS id_autor,
    d.id AS id_disciplina
FROM obras o

-- Relación con autores
JOIN obras_autores oc 
    ON oa.obra_id = o.id
JOIN autores c 
    ON oa.autor_id = a.id

-- Relación con disciplinas
JOIN obras_disciplinas od 
    ON od.obra_id = o.id
JOIN disciplinas d 
    ON od.disciplina_id = d.id

WHERE o.id='$id'";

    $obra = consulta($sql);

    debug_print_r($obra, 'no indentado');
    
    $obra=$obra[0]; // abrir primera identación
    
    debug_print_r($obra,'tras abrir indentación');
?>

<div class="ficha">
    <img src="<?=$obra['imagen']?>"/>
    <div>
    <h1><?=$obra['titulo']?></h1>
    <a href="autor.php?id=<?=$obra['id_autor']?>"><?=$obra['autor']?></a>
    <p><?=$obra['año']?></p>
    <p><?=$obra['descripcion']?></p>
    <a href="disciplina.php?id=<?=$obra['id_disciplina']?>"><?=$obra['disciplina']?></a>
    </div>    

    </div>


<?getfooter();?>
```






## 07 Creamos la ficha de autores.php

La consulta será la siguiente:
```sql
SELECT o.*, a.*
FROM obras o
JOIN obras_autores oc
    ON oa.obra_id = o.id
JOIN autores c
    ON oa.obra_id = a.id
WHERE oa.autor_id = 1;
```