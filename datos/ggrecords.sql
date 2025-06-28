-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS ggrecords CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ggrecords;

-- Tabla: usuarios
CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `usuario` VARCHAR(20) NOT NULL,
  `correo` VARCHAR(30) NOT NULL,
  `contrasena_hash` VARCHAR(255) NOT NULL,
  `rol` ENUM('usuario','admin') DEFAULT 'usuario',
  `fecha_registro` DATETIME DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla: Vacante
CREATE TABLE `Vacante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `criterio_1` VARCHAR(50) NOT NULL,
  `criterio_2` VARCHAR(100) NOT NULL,
  `criterio_3` INT(11) NOT NULL,
  `criterio_4` ENUM('Alto','Medio','Bajo') NOT NULL,
  `criterio_5` VARCHAR(20) NOT NULL,
  `criterio_6` VARCHAR(20) NOT NULL,
  `criterio_7` VARCHAR(50) NOT NULL,
  `criterio_8` ENUM('Sí','No') NOT NULL,
  `criterio_9` INT(11) NOT NULL,
  `criterio_10` INT(11) NOT NULL,
  `criterio_11` ENUM('Sí','No') NOT NULL,
  `criterio_12` ENUM('Sí','No') NOT NULL,
  `fecha_creacion` TIMESTAMP NULL DEFAULT current_timestamp(),
  `estado` ENUM('activa','inactiva') DEFAULT 'activa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla: postulaciones
CREATE TABLE `postulaciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `id_vacante` INT(11) NOT NULL,
  `fecha_postulacion` DATETIME DEFAULT current_timestamp(),
  `estado` ENUM('pendiente','aceptada','rechazada') DEFAULT 'pendiente',
  `cv_pdf` VARCHAR(255) DEFAULT NULL,
  `observaciones` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_vacante` (`id_vacante`),
  CONSTRAINT `postulaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `postulaciones_ibfk_2` FOREIGN KEY (`id_vacante`) REFERENCES `Vacante` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
