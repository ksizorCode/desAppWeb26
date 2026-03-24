-- Adminer 4.8.3 MySQL 8.0.35 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `arcadenoe`;
CREATE DATABASE `arcadenoe` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `arcadenoe`;

DROP TABLE IF EXISTS `animales`;
CREATE TABLE `animales` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `nombre_animal` varchar(255) NOT NULL,
  `foto_animal` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `id_especie` int DEFAULT NULL,
  PRIMARY KEY (`id_animal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `animales` (`id_animal`, `nombre_animal`, `foto_animal`, `descripcion`, `id_especie`) VALUES
(1,	'elefante',	'ele.jpg',	'bichu grandón con trompa',	1),
(2,	'león',	'leon.jpg',	'el rey de la selva',	2),
(3,	'tiburón',	'tiburon.jpg',	'el malo de nemo',	3),
(4,	'perro',	'rex.jpg',	'el mejor amigo del hombre',	4),
(5,	'gato',	'tirso.jpg',	'el peor amigo del hombre',	2),
(6,	'pez espada',	'espada.jpg',	'el pez que hace esgrima',	3),
(7,	'rinoceronte',	'rino.jpg',	'cuidado con el cuerno',	1),
(8,	'camello',	'cammel.jpg',	'aguante mucho sin beber',	5),
(9,	'salmón',	'salmon.jpg',	'ta muy bueno ahumado',	3),
(10,	'bonito',	'bonito.jpg',	'es un pez que no es feo',	3),
(11,	'sardina',	'sardina.jpg',	'pez azul',	3),
(12,	'trucha',	'trucha.jpg',	'surcan los mares y los rios',	3),
(13,	'cucaracha',	'cucaracha.jpg',	'sobrevive apocalipsis nucleares',	6),
(14,	'burro',	'burro.jpg',	'un animal muy listo',	7),
(15,	'jirafa',	'jiraf.jpg',	'animal con el cuello muy alto',	5),
(16,	'vacas',	'cow.jpg',	'tienen varios estómagos',	8),
(17,	'oveja',	'oveja.jpg',	'tienen mucha lana',	9);

DROP TABLE IF EXISTS `especies`;
CREATE TABLE `especies` (
  `id_especie` int NOT NULL AUTO_INCREMENT,
  `nombre_especie` text NOT NULL,
  `icono` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_especie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `especies` (`id_especie`, `nombre_especie`, `icono`) VALUES
(1,	'paquidermo',	'paquidermo.jpg'),
(2,	'felino',	'icono_gato.jpg'),
(3,	'pez',	'iconoPez.jpg'),
(4,	'canino',	'icono-perro.jpg'),
(5,	'camelido',	'camello.jpg'),
(6,	'insecto',	'icono_bug.jpg'),
(7,	'equino',	'icono_caballo.png'),
(8,	'bovino',	'icono_vaca.png'),
(9,	'ovino',	'ico_ovino.svg');

-- 2025-03-05 13:15:29
