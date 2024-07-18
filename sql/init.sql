-- init.sql

CREATE DATABASE Mugumis;

USE Mugumis;

CREATE TABLE Inventario_de_amigurumis (
    id_amigurumis VARCHAR(6) PRIMARY KEY,
    nombre VARCHAR(25),
    descripcion VARCHAR(200),
    precio DECIMAL(10, 2),
    cantidad_disponible INT,
    direccion_url VARCHAR(255) NOT NULL,
    CONSTRAINT chk_url CHECK (direccion_url REGEXP '^(http|https)://')
);

CREATE TABLE Cliente (
    id_correo VARCHAR(50) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    telefono VARCHAR(20),
    fk_amigurumis VARCHAR(50),
    FOREIGN KEY (fk_amigurumis) REFERENCES Inventario_de_amigurumis(id_amigurumis)
);

-- CREATE TABLE Inventario_materiales (
--     id_materiales VARCHAR(50) PRIMARY KEY,
--     descripcion VARCHAR(50),
--     cantidad INT,
--     proveedor VARCHAR(50)
-- );

CREATE TABLE Empleado (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    correo VARCHAR(50),
    fk_amigurumis VARCHAR(50),
    FOREIGN KEY (fk_amigurumis) REFERENCES Inventario_de_amigurumis(id_amigurumis)
    -- fk_materiales VARCHAR(50),
    -- FOREIGN KEY (fk_materiales) REFERENCES Inventario_materiales(id_materiales)
);

CREATE TABLE Pedido (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(20),
    fecha DATE,
    metodo_pago VARCHAR(20),
    fk_empleado INT,
    fk_cliente VARCHAR(50),
    FOREIGN KEY (fk_empleado) REFERENCES Empleado(id_empleado),
    FOREIGN KEY (fk_cliente) REFERENCES Cliente(id_correo)
);

INSERT INTO `Empleado` (`nombre`, `apellido`, `correo`, `fk_amigurumis`) VALUES ('Chirag', 'Ahir', 'chirag@upt.com', 'MU9732');