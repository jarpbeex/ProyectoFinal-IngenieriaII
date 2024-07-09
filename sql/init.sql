-- init.sql

CREATE DATABASE IF NOT EXISTS Mugumis;

USE Mugumis;

CREATE TABLE IF NOT EXISTS Inventario_de_amigurumis (
    id_amigurumis VARCHAR(6) PRIMARY KEY,
    nombre VARCHAR(25),
    descripcion VARCHAR(200),
    precio DECIMAL(10, 2),
    cantidad_disponible INT,
    direccion_url VARCHAR(255) NOT NULL,
    CONSTRAINT chk_url CHECK (direccion_url ~ '^(http|https)://')
);

CREATE TABLE IF NOT EXISTS Cliente (
    id_correo VARCHAR(50) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    telefono VARCHAR(20),
    fk_amigurumis VARCHAR(50),
    FOREIGN KEY (fk_amigurumis) REFERENCES Inventario_de_amigurumis(id_amigurumis)
);

CREATE TABLE IF NOT EXISTS Inventario_materiales (
    id_materiales VARCHAR(50) PRIMARY KEY,
    descripcion VARCHAR(50),
    cantidad INT,
    proveedor VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Empleado (
    id_empleado VARCHAR(50) PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    correo VARCHAR(50),
    fk_amigurumis VARCHAR(50),
    fk_materiales VARCHAR(50),
    FOREIGN KEY (fk_amigurumis) REFERENCES Inventario_de_amigurumis(id_amigurumis),
    FOREIGN KEY (fk_materiales) REFERENCES Inventario_materiales(id_materiales)
);

CREATE TABLE IF NOT EXISTS Pedido (
    id_pedido VARCHAR(50) PRIMARY KEY,
    estado VARCHAR(20),
    fecha DATE,
    metodo_pago VARCHAR(20),
    fk_empleado VARCHAR(50),
    fk_cliente VARCHAR(50),
    FOREIGN KEY (fk_empleado) REFERENCES Empleado(id_empleado),
    FOREIGN KEY (fk_cliente) REFERENCES Cliente(id_correo)
);

