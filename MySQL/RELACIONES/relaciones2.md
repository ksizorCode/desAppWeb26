# Tipos de Relaciones en Bases de Datos
 
En un modelo relacional, las **relaciones** describen cómo dos tablas están conectadas entre sí a través de claves. Existen tres tipos principales.
 
---
 
## Conceptos previos
 
- **Clave primaria (PK):** identificador único de cada fila en una tabla.
- **Clave foránea (FK):** columna que referencia la clave primaria de otra tabla. Es el mecanismo físico que implementa las relaciones.
- **Integridad referencial:** garantiza que una FK siempre apunte a un registro existente.
 
---
 
## 1. Uno a Uno (1:1)
 
Cada registro de la tabla A corresponde a **exactamente un** registro en la tabla B, y viceversa.
 
Se usa principalmente para separar datos sensibles o poco accedidos de la tabla principal.
 
### Ejemplo: Persona y Pasaporte
 
Una persona tiene un único pasaporte, y ese pasaporte pertenece a una única persona.
 
**Tabla `persona`**
 
| id (PK) | nombre        | fecha_nac  |
|---------|---------------|------------|
| 1       | Ana García    | 1990-04-12 |
| 2       | Luis Martínez | 1985-09-03 |
 
**Tabla `pasaporte`**
 
| id (PK) | numero    | expiracion | persona_id (FK) |
|---------|-----------|------------|-----------------|
| 101     | AAA123456 | 2030-01-01 | 1               |
| 102     | BBB789012 | 2028-06-15 | 2               |
 
La FK `persona_id` en `pasaporte` garantiza que cada pasaporte esté vinculado a exactamente una persona.
 
```sql
CREATE TABLE persona (
    id         INT PRIMARY KEY,
    nombre     VARCHAR(100),
    fecha_nac  DATE
);
 
CREATE TABLE pasaporte (
    id          INT PRIMARY KEY,
    numero      VARCHAR(20),
    expiracion  DATE,
    persona_id  INT UNIQUE REFERENCES persona(id)
    -- UNIQUE obliga a que sea 1:1 (no puede repetirse persona_id)
);
```
 
---
 
## 2. Uno a Muchos (1:N)
 
Un registro de la tabla A puede estar relacionado con **múltiples** registros en la tabla B, pero cada registro de B pertenece a **un único** registro de A.
 
Es la relación más habitual en bases de datos relacionales. La clave foránea siempre vive en el lado "muchos".
 
### Ejemplo: Cliente y Pedidos
 
Un cliente puede realizar varios pedidos, pero cada pedido pertenece a un solo cliente.
 
**Tabla `cliente`**
 
| id (PK) | nombre         | email                |
|---------|----------------|----------------------|
| 1       | María López    | maria@email.com      |
| 2       | Carlos Ruiz    | carlos@email.com     |
 
**Tabla `pedido`**
 
| id (PK) | fecha      | total  | cliente_id (FK) |
|---------|------------|--------|-----------------|
| 10      | 2024-01-15 | 59.99  | 1               |
| 11      | 2024-02-03 | 120.00 | 1               |
| 12      | 2024-02-10 | 34.50  | 2               |
 
María López (cliente 1) tiene dos pedidos (10 y 11). Carlos Ruiz (cliente 2) tiene uno (12).
 
```sql
CREATE TABLE cliente (
    id      INT PRIMARY KEY,
    nombre  VARCHAR(100),
    email   VARCHAR(150)
);
 
CREATE TABLE pedido (
    id          INT PRIMARY KEY,
    fecha       DATE,
    total       DECIMAL(10,2),
    cliente_id  INT REFERENCES cliente(id)
    -- Sin UNIQUE: un cliente puede tener muchos pedidos
);
```
 
---
 
## 3. Muchos a Muchos (N:M)
 
Varios registros de A pueden relacionarse con varios registros de B, y viceversa.
 
Para implementar esta relación se usa una **tabla intermedia** (o tabla de unión) que almacena las claves foráneas de ambas tablas. Esta tabla puede además contener atributos propios de la relación.
 
### Ejemplo: Estudiantes y Cursos
 
Un estudiante puede matricularse en varios cursos, y un curso puede tener varios estudiantes.
 
**Tabla `estudiante`**
 
| id (PK) | nombre          |
|---------|-----------------|
| 1       | Elena Fernández |
| 2       | Jorge Morales   |
| 3       | Sara Ibáñez     |
 
**Tabla `curso`**
 
| id (PK) | titulo              | creditos |
|---------|---------------------|----------|
| 10      | Bases de Datos      | 6        |
| 20      | Programación Web    | 4        |
| 30      | Redes y Sistemas    | 5        |
 
**Tabla intermedia `matricula`**
 
| estudiante_id (FK) | curso_id (FK) | fecha_alta | nota_final |
|--------------------|---------------|------------|------------|
| 1                  | 10            | 2024-09-01 | 8.5        |
| 1                  | 20            | 2024-09-01 | 7.0        |
| 2                  | 10            | 2024-09-02 | 9.0        |
| 3                  | 20            | 2024-09-03 | NULL       |
| 3                  | 30            | 2024-09-03 | NULL       |
 
Elena está en Bases de Datos y Programación Web. El curso de Bases de Datos tiene tanto a Elena como a Jorge.
 
```sql
CREATE TABLE estudiante (
    id      INT PRIMARY KEY,
    nombre  VARCHAR(100)
);
 
CREATE TABLE curso (
    id        INT PRIMARY KEY,
    titulo    VARCHAR(150),
    creditos  INT
);
 
CREATE TABLE matricula (
    estudiante_id  INT REFERENCES estudiante(id),
    curso_id       INT REFERENCES curso(id),
    fecha_alta     DATE,
    nota_final     DECIMAL(4,2),
    PRIMARY KEY (estudiante_id, curso_id)  -- clave primaria compuesta
);
```
 
---
 
## Resumen comparativo
 
| Tipo          | Notación | Clave foránea              | Ejemplo típico          |
|---------------|----------|----------------------------|-------------------------|
| Uno a uno     | 1:1      | En cualquiera de las dos   | Persona — Pasaporte     |
| Uno a muchos  | 1:N      | En la tabla del lado "N"   | Cliente — Pedidos       |
| Muchos a muchos | N:M    | En tabla intermedia        | Estudiante — Curso      |
 
---
 
## Nota sobre integridad referencial
 
Si intentas insertar un pedido con un `cliente_id` que no existe en la tabla `cliente`, la base de datos rechazará la operación. Este comportamiento se puede configurar con:
 
- `ON DELETE CASCADE` — borra los registros relacionados automáticamente.
- `ON DELETE SET NULL` — pone la FK a `NULL` cuando se borra el padre.
- `ON DELETE RESTRICT` — impide borrar el registro padre si tiene hijos (comportamiento por defecto).
