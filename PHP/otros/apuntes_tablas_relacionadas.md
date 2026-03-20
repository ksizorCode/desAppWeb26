# Apuntes tablas relacionables


## Creación de Tabla Animales
```sql
CREATE TABLE `animales` (
  `id_animal` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre_animal` varchar(255) NOT NULL,
  `foto_animal` varchar(255) NULL,
  `descripcion` text NULL,
  `id_especie` int NULL
);

```

## Creación de Tabla Especies

```sql
CREATE TABLE `especies` (
  `id_especie` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre_especie` text NOT NULL,
  `icono` varchar(255) NULL
);
```

## Insertamos datos con los que jugar en Animales

```sql
INSERT INTO `animales` (`nombre_animal`, `foto_animal`, `descripcion`, `id_especie`)
VALUES ('elefante', 'ele.jpg', 'bichu grandón con trompa', 1),
('león', 'leon.jpg', 'el rey de la selva', 2),
('tiburón', 'tiburon.jpg', 'el malo de nemo', 3),
('perro', 'rex.jpg', 'el mejor amigo del hombre', 4),
('gato', 'tirso.jpg', 'el peor amigo del hombre', 2),
('pez espada', 'espada.jpg', 'el pez que hace esgrima', 3),
('rinoceronte', 'rino.jpg', 'cuidado con el cuerno', 1);
```

si quieres puedes insertar más datos volviendo a añadir esto:
```sql
INSERT INTO `animales` (`nombre_animal`, `foto_animal`, `descripcion`, `id_especie`)
VALUES ('camello', 'cammel.jpg', 'aguante mucho sin beber', 5),
('salmón', 'salmon.jpg', 'ta muy bueno ahumado', 3),
('bonito', 'bonito.jpg', 'es un pez que no es feo', 3),
('sardina', 'sardina.jpg', 'pez azul', 3),
('trucha', 'trucha.jpg', 'surcan los mares y los rios', 3),
('cucaracha', 'cucaracha.jpg', 'sobrevive apocalipsis nucleares', 6),
('burro', 'burro.jpg', 'un animal muy listo', 7),
('jirafa','jiraf.jpg','animal con el cuello muy alto',5),
('vacas','cow.jpg','tienen varios estómagos',8),
('oveja','oveja.jpg','tienen mucha lana',9);```


## insertamos datos en Especies

|id_especie	|nombre_especie	|icono|
|-----------|---------------|-----|
|1	|paquidermo	|paquidermo.jpg|
|2	|felino	|icono_gato.jpg|
|3	|pez	|iconoPez.jpg|
|4	|canino	|icono-perro.jpg|


```sql
INSERT INTO `especie` (`nombre_especie`, `icono`)
VALUES ('paquidermo', 'i_paquidermo.jpg'),
('felino', 'icono_gato.jpg'),
('pez', 'iconoPez.jpg'),
('canino', 'icono-perro.jpg');
```

Si has añadido el segundo bloque de animales, añade también sus especies:
```sql
INSERT INTO especies (nombre_especie, icono)
VALUES
('camelido', 'camello.jpg'),
('insecto', 'icono_bug.jpg'),
('equino', 'icono_caballo.png'),
('bovino', 'icono_vaca.png'),
('ovino', 'ico_ovino.svg'```

# Relacionamos las Dos Tablas:

```sql
SELECT nombre_animal, descripcion, nombre_especie FROM animales, especies WHERE animales.id_especie = especies.id_especie

```


Versión simplificada:
```sql
SELECT nombre_animal, descripcion, nombre_especie FROM animales A, especies B WHERE A.id_especie = B.id_especie

```



# Jugando con las consultas
Estos son algunos ejemplos de consultas con las que podemos hacer pruebas para entender el funcionamiento de las consultas SQL:

```sql
SELECT * FROM animales WHERE id_animal= 1
SELECT * FROM animales WHERE nombre_animal= 'elefante'
SELECT * FROM animales WHERE foto_animal= 'ele.jpg'
SELECT * FROM animales WHERE id_especie= 1
SELECT nombre_animal, descripcion FROM animales WHERE id_animal= 1

SELECT * FROM animales WHERE nombre_animal = 'tiburón'

// si puede contar con caracteres raros pon esto:
SELECT * FROM animales WHERE nombre_animal LIKE'tiburón'

SELECT * FROM animales WHERE id_animal=4 OR nombre_animal='elefante'

SELECT * FROM animales WHERE id_animal=1 AND nombre_animal='elefante'

// Combinar tablas:
SELECT * FROM animales, especies WHERE animales.id_especie = especies.id_especie 

SELECT nombre_especie, nombre_animal FROM animales, especies WHERE animales.id_especie = especies.id_especie 


SELECT nombre_especie, nombre_animal FROM animales, especies WHERE animales.id_especie = especies.id_especie ORDER BY nombre_especie ASC

SELECT nombre_animal, nombre_especie FROM animales, especies WHERE animales.id_especie = especies.id_especie ORDER BY nombre_animal DESC

SELECT nombre_animal, nombre_especie FROM animales, especies WHERE animales.id_especie = especies.id_especie ORDER BY nombre_especie, nombre_animal ASC

SELECT nombre_animal, nombre_especie FROM animales A, especies E WHERE A.id_especie=E.id_especie ORDER BY nombre_especie, nombre_animal ASC



```