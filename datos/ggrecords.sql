-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ggrecords;
USE ggrecords;

-- Crear tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena_hash VARCHAR(255) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS vacantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    departamento VARCHAR(100) NOT NULL,
    fecha_publicacion DATE NOT NULL,
    fecha_cierre DATE NOT NULL,
    estado ENUM('activa', 'inactiva') DEFAULT 'activa',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

