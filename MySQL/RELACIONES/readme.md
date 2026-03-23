# Bases de datos relacionales

Vamos a crear una base de datos con 2-3 tablas de datos relacionadas entre sí.

---

## DB Pelis

### Estructura de tablas

**Tablas de datos**

| Tabla       | Campos                        |
|-------------|-------------------------------|
| `peliculas` | `id`, `nombre`, `anio`        |
| `director`  | `id`, `nombre`                |

**Tabla de relación**

| Tabla               | Campos                                  |
|---------------------|-----------------------------------------|
| `peliculas_director` | `id`, `id_pelicula`, `id_director`     |

---

### Datos de ejemplo

| Título                                           | Año  | Director          |
|--------------------------------------------------|------|-------------------|
| La lista de Schindler                            | 1993 | Steven Spielberg  |
| Volver a empezar                                 | 1982 | José Luis Garci   |
| Holocausto caníbal                               | 1980 | Ruggero Deodato   |
| Jurassic Park                                    | 1994 | Steven Spielberg  |
| El abuelo                                        | 1998 | José Luis Garci   |
| Indiana Jones: En busca del arca perdida         | 1981 | Steven Spielberg  |
| La guerra de las galaxias: Una nueva esperanza   | 1977 | George Lucas      |

---

## Desarrollo técnico

### 01. Crear nueva base de datos

En AdminerNeo (o el sistema que estemos usando), crear una nueva base de datos vacía.

---

### 02. Crear las tablas

#### Tabla `peliculas`
```sql
CREATE TABLE `peliculas` (
  `id`     INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `anio`   INT(4)       NOT NULL
);
```

#### Tabla `director`
```sql
CREATE TABLE `director` (
  `id`     INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL
);
```


### 0.3 Rellenamos las tablas con los siguientes datos:

Datos para la tabla películas
```sql
INSERT INTO `peliculas` (`nombre`,`anio`)
VALUES
('La lista de Shindler',1993),
('Volver a Empezar',1982),
('Holocausto Canibal',1980),
('Jurasic Park',1994),
('El Abuelo',1998),
('Indiana Jones. En Busca del Arca Perdida',1981),
('La Guerra de las Galaxias. Una nueva esperanza',1977)
;

```
Datos para directores
```sql
INSERT INTO `director` (`nombre`)
VALUES
('Steven Spielberg'),
('José Luis Garci'),
('Ruggero Deodato'),
('George Lucas'),
('Christopher Nolan')
;

```


### 0.4 Revisamos los datos insertados:

Revisamos peliculas:
```sql 
SELECT * FROM peliculas
```

Reivisamos director:
```sql 
SELECT * FROM director
```



---



> [!CAUTION]
> No puedes pasarrrr!!!!!
> ------
---



#### Tabla de relación `peliculas_director`
```sql
CREATE TABLE `peliculas_director` (
  `id`          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_pelicula` INT NOT NULL,
  `id_director` INT NOT NULL,
  FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas`(`id`),
  FOREIGN KEY (`id_director`) REFERENCES `director`(`id`)
);
```



Recuerda que si tienes que borrar todos los datos de una tabla puedes usar:

```sql
TRUNCATE TABLE NombreDeTuTabla;

```