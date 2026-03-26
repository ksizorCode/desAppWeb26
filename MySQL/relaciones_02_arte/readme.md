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

## 01. Testeo para ver si funciona:

```sql
#Testeos básico (jugando con consultas SQL)
SELECT * FROM obras

SELECT * FROM creadores

SELECT * FROM disciplinas

SELECT titulo FROM obras LIMIT 3

SELECT nombre, lugar FROM creadores ORDER BY lugar DESC
```

## 02. Relación entre Obras y Creadores
```sql
# Relacion Obra-Creador:
SELECT * 
FROM obras
JOIN obras_creadores 
    ON obras_creadores.obra_id = obras.id
JOIN creadores 
    ON obras_creadores.creador_id = creadores.id;
```
La consulta anterior nos devuelve un montón de datos innecesarios como IDs y otros valores que no nos interesan.

Realación con los datos limpios (con alias)
```sql
SELECT
    o.titulo AS "Título Obra",
    c.nombre AS "Nombre Autor" 
FROM obras o
JOIN obras_creadores oc
    ON oc.obra_id = o.id
JOIN creadores c
    ON oc.creador_id = c.id;
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
    c.nombre AS 'Nombre Autor',
    d.nombre AS 'Disciplina Artística'
FROM obras o

-- Relación con creadores
JOIN obras_creadores oc 
    ON oc.obra_id = o.id
JOIN creadores c 
    ON oc.creador_id = c.id

-- Relación con disciplinas
JOIN obras_disciplinas od 
    ON od.obra_id = o.id
JOIN disciplinas d 
    ON od.disciplina_id = d.id;
```

