-- Creación de base de datos "standex" y declaración de cotejamiento 
CREATE DATABASE standex CHARACTER SET utf8 COLLATE utf8_general_ci;
-- Creación de tabla "cliente" con 5 atributos
CREATE TABLE `cliente` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `numero_tarjeta` varchar(20) NOT NULL,
  `url_youtube` varchar(100) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `cliente` (`id`, `nombre`, `fecha_nacimiento`, `numero_tarjeta`, `url_youtube`) VALUES
(1, 'Jose Chavez Ayona', '2001-10-12', '4450 5310 5055 1739', 'https://www.youtube.com/watch?v=mr_g0P2CNr8'),
(2, 'Itzel Chavez Ayona', '1996-04-08', '5227 9333 3744 8557', 'https://www.youtube.com/channel/UCmS75G-98QihSusY7NfCZtw'),
(3, 'ADDISON WALKER', '2000-02-14', '5366 2563 7915 0126', 'https://youtu.be/h4HVrX8VDTM'),
(4, 'BROOKLYN MOOR', '2023-05-30', '5119 6465 8366 7529', 'https://youtu.be/ORQp8YNzwyI');

-- Creación de llave primaria a campo "id"
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);
-- Tipo de dato de llave primaria
ALTER TABLE `cliente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
