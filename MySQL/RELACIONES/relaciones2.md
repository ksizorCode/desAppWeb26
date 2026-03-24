# 🗄️ Apuntes de Bases de Datos Relacionales

Guía completa sobre **relaciones** y **claves** en bases de datos, con ejemplos prácticos usando un sistema de tienda online.

---

# 🔗 Parte 1: Tipos de Relaciones

Las relaciones describen cómo dos tablas están conectadas entre sí. Existen tres tipos principales.

---

## 1️⃣ Uno a Uno (1:1)

Cada registro de la tabla A corresponde a **exactamente un** registro en la tabla B, y viceversa.

Se usa principalmente para separar datos sensibles o poco accedidos de la tabla principal.

### 📌 Ejemplo: Persona y Pasaporte

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
    -- UNIQUE obliga a que sea 1:1
);
```

---

## 🔢 Uno a Muchos (1:N)

Un registro de la tabla A puede estar relacionado con **múltiples** registros en la tabla B, pero cada registro de B pertenece a **un único** registro de A.

Es la relación **más habitual**. La clave foránea siempre vive en el lado "muchos".

### 📌 Ejemplo: Cliente y Pedidos

Un cliente puede realizar varios pedidos, pero cada pedido pertenece a un solo cliente.

**Tabla `cliente`**

| id (PK) | nombre       | email            |
|---------|--------------|------------------|
| 1       | María López  | maria@email.com  |
| 2       | Carlos Ruiz  | carlos@email.com |

**Tabla `pedido`**

| id (PK) | fecha      | total  | cliente_id (FK) |
|---------|------------|--------|-----------------|
| 10      | 2024-01-15 | 59.99  | 1               |
| 11      | 2024-02-03 | 120.00 | 1               |
| 12      | 2024-02-10 | 34.50  | 2               |

María López tiene dos pedidos (10 y 11). Carlos Ruiz tiene uno (12).

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
);
```

---

## 🔀 Muchos a Muchos (N:M)

Varios registros de A pueden relacionarse con varios registros de B, y viceversa.

Se implementa con una **tabla intermedia** que almacena las FK de ambas tablas. Esta tabla puede además tener atributos propios de la relación.

### 📌 Ejemplo: Estudiantes y Cursos

Un estudiante puede matricularse en varios cursos, y un curso puede tener varios estudiantes.

**Tabla `estudiante`**

| id (PK) | nombre          |
|---------|-----------------|
| 1       | Elena Fernández |
| 2       | Jorge Morales   |
| 3       | Sara Ibáñez     |

**Tabla `curso`**

| id (PK) | titulo           | creditos |
|---------|------------------|----------|
| 10      | Bases de Datos   | 6        |
| 20      | Programación Web | 4        |
| 30      | Redes y Sistemas | 5        |

**Tabla intermedia `matricula`**

| estudiante_id (FK) | curso_id (FK) | fecha_alta | nota_final |
|--------------------|---------------|------------|------------|
| 1                  | 10            | 2024-09-01 | 8.5        |
| 1                  | 20            | 2024-09-01 | 7.0        |
| 2                  | 10            | 2024-09-02 | 9.0        |
| 3                  | 20            | 2024-09-03 | NULL       |

```sql
CREATE TABLE matricula (
    estudiante_id  INT REFERENCES estudiante(id),
    curso_id       INT REFERENCES curso(id),
    fecha_alta     DATE,
    nota_final     DECIMAL(4,2),
    PRIMARY KEY (estudiante_id, curso_id)
);
```

---

## 📊 Resumen de relaciones

| Tipo            | Notación | Clave foránea            | Ejemplo típico       |
|-----------------|----------|--------------------------|----------------------|
| Uno a uno       | 1:1      | En cualquiera de las dos | Persona — Pasaporte  |
| Uno a muchos    | 1:N      | En la tabla del lado "N" | Cliente — Pedidos    |
| Muchos a muchos | N:M      | En tabla intermedia      | Estudiante — Curso   |

---

---

# 🔑 Parte 2: Tipos de Claves

Las **claves** son columnas (o conjuntos de columnas) que identifican o relacionan registros. Cada tipo cumple un rol distinto.

> 💡 Todos los ejemplos usan el mismo sistema de tienda online para ver cómo interactúan entre sí.

---

## 🏷️ 1. Clave Primaria (Primary Key — PK)

Identifica de forma **única e irrepetible** cada fila de una tabla. No puede ser `NULL` ni repetirse.

```sql
CREATE TABLE cliente (
    id      INT PRIMARY KEY,   -- clave primaria
    nombre  VARCHAR(100),
    email   VARCHAR(150)
);
```

**Tabla `cliente`**

| **id (PK)** | nombre        | email           |
|-------------|---------------|-----------------|
| **1**       | Ana García    | ana@email.com   |
| **2**       | Luis Martínez | luis@email.com  |
| **3**       | María López   | maria@email.com |

> ⚠️ No puede existir otro cliente con `id = 1`, ni ningún cliente con `id = NULL`.

---

## 🔗 2. Clave Foránea (Foreign Key — FK)

Columna que **referencia la PK de otra tabla**. Garantiza que no puedas insertar un valor que no exista en la tabla referenciada.

```sql
CREATE TABLE pedido (
    id          INT PRIMARY KEY,
    fecha       DATE,
    total       DECIMAL(10,2),
    cliente_id  INT REFERENCES cliente(id)   -- clave foránea
);
```

**Tabla `pedido`**

| id (PK) | fecha      | total  | **cliente_id (FK)** |
|---------|------------|--------|---------------------|
| 101     | 2024-01-10 | 59.99  | **1**               |
| 102     | 2024-02-03 | 120.00 | **1**               |
| 103     | 2024-03-15 | 34.50  | **2**               |

> ⚠️ Si intentas insertar un pedido con `cliente_id = 99` (inexistente), la base de datos lo rechaza.

---

## 🎯 3. Clave Candidata (Candidate Key)

Cualquier columna que **podría ser** clave primaria: sus valores son únicos y nunca nulos. Una tabla puede tener varias; solo una se elige como PK.

```sql
CREATE TABLE cliente (
    id      INT PRIMARY KEY,       -- elegida como PK
    nombre  VARCHAR(100),
    email   VARCHAR(150) UNIQUE    -- también candidata, pero no PK
);
```

| id (PK) | nombre        | **email (candidata)**  |
|---------|---------------|------------------------|
| 1       | Ana García    | ana@email.com          |
| 2       | Luis Martínez | luis@email.com         |

Tanto `id` como `email` identifican unívocamente a un cliente. Se eligió `id` por ser más compacto y estable.

---

## ✅ 4. Clave Única (Unique Key)

Igual que la PK en cuanto a unicidad, pero **sí permite un valor `NULL`** y puede haber varias en la misma tabla.

```sql
CREATE TABLE producto (
    id       INT PRIMARY KEY,
    nombre   VARCHAR(150),
    sku      VARCHAR(50) UNIQUE,   -- clave única
    ean      VARCHAR(13) UNIQUE    -- otra clave única
);
```

**Tabla `producto`**

| id (PK) | nombre     | **sku (unique)** | **ean (unique)** |
|---------|------------|------------------|------------------|
| 1       | Camiseta S | CAM-S-001        | 1234567890123    |
| 2       | Camiseta M | CAM-M-001        | 1234567890124    |
| 3       | Pantalón   | PAN-L-001        | NULL             |

> 💡 No puede haber dos productos con el mismo `sku`, pero sí puede haber varios con `ean = NULL`.

---

## 🧩 5. Clave Compuesta (Composite Key)

PK formada por **dos o más columnas** que juntas identifican unívocamente cada fila. Ninguna columna por sí sola es suficiente.

Aparece típicamente en las tablas intermedias de relaciones N:M.

```sql
CREATE TABLE detalle_pedido (
    pedido_id    INT REFERENCES pedido(id),
    producto_id  INT REFERENCES producto(id),
    cantidad     INT,
    precio_unit  DECIMAL(10,2),
    PRIMARY KEY (pedido_id, producto_id)   -- clave compuesta
);
```

**Tabla `detalle_pedido`**

| **pedido_id (PK)** | **producto_id (PK)** | cantidad | precio_unit |
|--------------------|----------------------|----------|-------------|
| **101**            | **1**                | 2        | 19.99       |
| **101**            | **2**                | 1        | 24.99       |
| **102**            | **1**                | 3        | 19.99       |

> 💡 `pedido_id = 101` puede repetirse y `producto_id = 1` también, pero la combinación `(101, 1)` es única.

---

## 🌐 6. Superclave (Superkey)

Cualquier conjunto de columnas que **garantiza unicidad**, aunque incluya columnas innecesarias. Es el concepto más amplio de todos.

> Toda clave primaria es una superclave, pero no toda superclave es una clave primaria.

En la tabla `cliente`:

| Superclave              | ¿Es mínima?               |
|-------------------------|---------------------------|
| `{id}`                  | ✅ Sí → clave candidata   |
| `{email}`               | ✅ Sí → clave candidata   |
| `{id, email}`           | ❌ No (sobra `email`)     |
| `{id, nombre, email}`   | ❌ No (sobran columnas)   |

Las superclaves mínimas (sin columnas redundantes) son las **claves candidatas**.

---

## 📊 Resumen de claves

| Tipo           | Unicidad | Permite NULL | Cantidad por tabla | Uso principal                      |
|----------------|----------|--------------|--------------------|-------------------------------------|
| Primaria (PK)  | ✅       | ❌           | 1                  | Identificar cada fila               |
| Foránea (FK)   | ❌       | ✅           | Varias             | Relacionar tablas                   |
| Candidata      | ✅       | ❌           | Varias             | Columnas aptas para ser PK          |
| Única          | ✅       | ✅ (un NULL) | Varias             | Unicidad sin ser PK                 |
| Compuesta      | ✅       | ❌           | 1                  | PK formada por varias columnas      |
| Superclave     | ✅       | —            | Muchas             | Concepto teórico de unicidad amplia |

---

## 🛡️ Integridad referencial

Al definir claves foráneas, puedes controlar qué ocurre cuando se borra o actualiza un registro padre:

| Opción              | Comportamiento                                               |
|---------------------|--------------------------------------------------------------|
| `ON DELETE CASCADE`    | Borra automáticamente los registros hijos                 |
| `ON DELETE SET NULL`   | Pone la FK a `NULL` cuando se borra el padre              |
| `ON DELETE RESTRICT`   | Impide borrar el padre si tiene hijos *(comportamiento por defecto)* |
