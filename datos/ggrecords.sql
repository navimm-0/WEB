-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ggrecords;
USE ggrecords;

-- Crear tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    usuario VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(30) NOT NULL UNIQUE,
    contrasena_hash VARCHAR(20) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS Vacante;

CREATE TABLE Vacante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(25) NOT NULL,
    descripcion TEXT NOT NULL,

    criterio_1 VARCHAR(50) NOT NULL,   
    criterio_2 VARCHAR(100) NOT NULL,    
    criterio_3 INT NOT NULL,             
    criterio_4 ENUM('Sí', 'No') NOT NULL,   
    criterio_5 VARCHAR(20) NOT NULL,     
    criterio_6 VARCHAR(20) NOT NULL,     
    criterio_7 VARCHAR(50) NOT NULL,     
    criterio_8 ENUM('Sí', 'No') NOT NULL,   
    criterio_9 INT NOT NULL,            
    criterio_10 INT NOT NULL,           
    criterio_11 ENUM('Sí', 'No') NOT NULL, 
    criterio_12 ENUM('Sí', 'No') NOT NULL,  

    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



