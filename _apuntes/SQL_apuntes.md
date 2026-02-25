
# Apuntes de MySQL

Bienvenido a los apuntes de MySQL. Aquí encontrarás información esencial para trabajar con bases de datos relacionales utilizando MySQL.

## Índice

1. [Introducción a MySQL](#introducción-a-mysql)
2. [Tipos de Datos](#tipos-de-datos)
3. [Comandos Básicos](#comandos-básicos)
4. [Consultas Avanzadas](#consultas-avanzadas)

---

## Introducción a MySQL

MySQL es un sistema de gestión de bases de datos relacional (RDBMS) basado en SQL (Structured Query Language).

- **Comando para iniciar sesión:**
  ```sh
  mysql -u usuario -p
  ```
- **Comando para seleccionar una base de datos:**
  ```sql
  USE nombre_base_de_datos;
  ```

---

## Tipos de Datos

| Tipo | Descripción | Ejemplo |
|------|------------|---------|
| `INT` | Número entero | `edad INT NOT NULL` |
| `VARCHAR(n)` | Cadena de texto de longitud `n` | `nombre VARCHAR(50)` |
| `TEXT` | Texto largo | `descripcion TEXT` |
| `DATE` | Fecha en formato `YYYY-MM-DD` | `fecha_nacimiento DATE` |
| `DECIMAL(m,d)` | Número decimal con `m` dígitos y `d` decimales | `precio DECIMAL(10,2)` |

---

## Comandos Básicos

### Crear una Base de Datos
```sql
CREATE DATABASE tienda;
```

### Crear una Tabla
```sql
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    fecha_registro DATE DEFAULT CURRENT_DATE
);
```

### Insertar Datos
```sql
INSERT INTO clientes (nombre, email) VALUES ('Juan Pérez', 'juan@example.com');
```

### Consultar Datos
```sql
SELECT * FROM clientes;
```

### Actualizar Datos
```sql
UPDATE clientes SET email = 'juan.perez@example.com' WHERE id = 1;
```

### Eliminar Datos
```sql
DELETE FROM clientes WHERE id = 1;
```

---

## Consultas Avanzadas

### Filtrar con `WHERE`
```sql
SELECT * FROM clientes WHERE fecha_registro >= '2024-01-01';
```

### Ordenar Resultados
```sql
SELECT * FROM clientes ORDER BY nombre ASC;
```

### Contar Registros
```sql
SELECT COUNT(*) FROM clientes;
```

### Unir Tablas (`JOIN`)
```sql
SELECT pedidos.id, clientes.nombre, pedidos.total 
FROM pedidos 
INNER JOIN clientes ON pedidos.cliente_id = clientes.id;
```

### Subconsultas
```sql
SELECT nombre FROM clientes WHERE id IN (SELECT cliente_id FROM pedidos WHERE total > 100);
```

### Agrupar Resultados (`GROUP BY`)
```sql
SELECT cliente_id, COUNT(*) AS cantidad_pedidos 
FROM pedidos 
GROUP BY cliente_id;
```

---

## 🚀 Contribuciones

Si quieres contribuir, ¡envía un pull request!

## 📜 Licencia

Este documento está bajo la licencia MIT.
