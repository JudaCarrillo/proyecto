CREATE DATABASE proyecto;
-- usuario
CREATE TABLE usuario (
    id_usu INT NOT NULL AUTO_INCREMENT , 
    nombre_usu VARCHAR(80) NOT NULL , 
    email_usu VARCHAR(80) NOT NULL , 
    password_usu VARCHAR(80) NOT NULL , 
    hash_password_usu VARCHAR(80) NOT NULL , 
    PRIMARY KEY (id_usu)) ENGINE = InnoDB;

-- cliente
CREATE TABLE cliente (
    id_cliente INT NOT NULL AUTO_INCREMENT , 
    nombre_cliente VARCHAR(80) NOT NULL ,
    email_cliente VARCHAR(80) NOT NULL,
    telf_cliente INT NOT NULL , 
    dni INT NOT NULL,
    fecha_registro DATE NOT NULL , 
    PRIMARY KEY (id_cliente)) ENGINE = InnoDB;

-- libros
CREATE TABLE libros (
    id_libro INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(80) NOT NULL ,
    autor VARCHAR(80) NOT NULL , 
    descripcion VARCHAR(80) NOT NULL , 
    stock INT NOT NULL ,
    costo INT NOT NULL , 
    PRIMARY KEY (id_libro)) ENGINE = InnoDB;

-- usuario administrador
INSERT INTO usuario (`nombre_usu`, `email_usu`, `password_usu`, `hash_password_usu`) VALUES ('Administrador', 'administrador@gmail.com', '123', '$2y$10$aj5ytC9wycDUtQO6rgEzcejtt37HKkXm0B2Wcjt99ZgU0NXFx7IlK')
