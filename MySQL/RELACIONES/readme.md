# Bases de Datos relacionadas
Vamos a hacer una base de datos conde generaremos 2 o 3 tablas con datos que relacionaremos entre sí.

## DB Películas

### Tablas de datos:
- Peliculas
· id
· nombre

- Director
· id
· nombre

### Tablas de relación
- peliculas-director
· id
· id_peliculas
· id_director


### Películas con las que jugar

- La lista de Shindler                              1993     Steven Spielberg
- Volver a Empezar                                  1982     Jose Luis Garci
- Holocausto canibal                                1980     Jugero de Odato
- Jurassic Park                                     1994     Steven Spielberg
- El Abuelo                                         1998     Jose Luis Garci
- Indiana Jones. En Busca del Arca Perdida          1981     Steven Spielberg
- La Guerra de las Galaxias. Una nueva Esperanza    1977     George Lucas



----

Una vez definido lo que vamos a hacer comencemos con el desarrollo técnico:


## 01. Crear Nueva base de datos
En AdminerNeo o el sistema que estemos utilizando creamos una nueva base de datos

## 02. Crear tablas

Craemos tablas de películas y directores:





Tabla películas
```sql

CREATE TABLE `peliculas` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `anio` int(4) NOT NULL

);

```
Tabla directores
```sql

CREATE TABLE `director` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL
);

```