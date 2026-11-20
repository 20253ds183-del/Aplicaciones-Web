-- Script de la base de datos AVS_03_04_01
-- AVS.03.04.01 Pagina de gestion de productos
-- Como se usa: en phpMyAdmin, pestana Importar, elegir este archivo
-- y pulsar Continuar. Tambien se puede pegar en la pestana SQL.
-- No hace falta crear la base antes: este script la crea.

CREATE DATABASE IF NOT EXISTS AVS_03_04_01
  CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

USE AVS_03_04_01;

-- Tabla de categorias de producto.
-- id_categoria es la llave primaria.
CREATE TABLE IF NOT EXISTS categorias (
  id_categoria INT(8) NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de productos.
-- id_producto es la llave primaria.
-- categoria_id es llave foranea: cada producto pertenece a una categoria.
-- ON DELETE RESTRICT evita borrar una categoria que todavia tiene productos.
-- ON UPDATE CASCADE actualiza el id si cambia en categorias.
CREATE TABLE IF NOT EXISTS productos (
  id_producto INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  precio DOUBLE NOT NULL,
  stock INT(100) NOT NULL,
  foto_p VARCHAR(100) DEFAULT NULL,
  categoria_id INT(11) NOT NULL,
  PRIMARY KEY (id_producto),
  CONSTRAINT fk_producto_categoria
    FOREIGN KEY (categoria_id) REFERENCES categorias (id_categoria)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo para las categorias.
INSERT INTO categorias (id_categoria, descripcion) VALUES
  (1, 'Electronica'),
  (2, 'Hogar'),
  (3, 'Ropa')
ON DUPLICATE KEY UPDATE descripcion = VALUES(descripcion);

-- Datos de ejemplo para los productos.
-- foto_p guarda solo el nombre del archivo, la foto esta en la carpeta imagenes/.
INSERT INTO productos (id_producto, nombre, precio, stock, foto_p, categoria_id) VALUES
  (1, 'Laptop HP 15', 12999.00, 10, 'laptop.jpg', 1),
  (2, 'Silla de oficina', 1899.00, 15, 'silla.jpg', 2),
  (3, 'Audifonos Bluetooth', 799.00, 25, 'audifonos.jpg', 1)
ON DUPLICATE KEY UPDATE
  nombre = VALUES(nombre),
  precio = VALUES(precio),
  stock = VALUES(stock),
  foto_p = VALUES(foto_p),
  categoria_id = VALUES(categoria_id);
