CREATE DATABASE sistema;
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
    img_cliente LONGBLOB NOT NULL,
    nombre_cliente VARCHAR(80) NOT NULL ,
    email_cliente VARCHAR(80) NOT NULL,
    telf_cliente INT NOT NULL , 
    dni INT(8) NOT NULL,
    fecha_registro DATE NOT NULL , 
    PRIMARY KEY (id_cliente)) ENGINE = InnoDB;

-- inmobiliaria
CREATE TABLE inmueble (
    id_inmueble INT NOT NULL AUTO_INCREMENT,
    ubicacion_inm VARCHAR(80) NOT NULL ,
    descripcion_inm VARCHAR(150) NOT NULL , 
    tamaño_inm INT NOT NULL , 
    costo_inm INT NOT NULL , 
    PRIMARY KEY (id_inmueble)) ENGINE = InnoDB;

-- terreno
CREATE TABLE terreno (
    id_terreno INT NOT NULL AUTO_INCREMENT,
    ubicacion_tem VARCHAR(80) NOT NULL ,
    descripcion_tem VARCHAR(150) NOT NULL , 
    tamaño_tem INT NOT NULL , 
    costo_tem INT NOT NULL , 
    PRIMARY KEY (id_terreno)) ENGINE = InnoDB;

