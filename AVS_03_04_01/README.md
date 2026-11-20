# AVS.03.04.01 — Página de gestión de productos

Aplicación web en PHP y MySQL (XAMPP) para gestionar productos:
insertar, listar, actualizar y borrar (CRUD), con foto del producto
y categoría. Base de datos: **AVS_03_04_01**.

## Estructura de carpetas y archivos

```
AVS_03_04_01/
├── index.php              Vista: menú principal
├── conexion.php           Conexión PDO a MySQL
├── Producto.php           Modelo: consultas a productos y categorías
├── productoCont.php       Controlador: decide insertar, actualizar o borrar
├── productoInsertar.php   Vista: formulario para insertar
├── productoActualizar.php Vista: formulario para actualizar
├── productoLista.php      Vista: tabla con todos los productos
├── css/
│   └── estilos.css
├── imagenes/              Fotos de los productos (se suben aquí)
│   ├── laptop.jpg
│   ├── silla.jpg
│   └── audifonos.jpg
└── sql/
    └── base_datos.sql     Script para crear la base de datos
```

Los nombres index, Producto, productoCont, productoInsertar y
productoLista son los de la Imagen 2 de la actividad. Se agregaron
conexion.php, productoActualizar.php (el formulario de actualizar),
css/estilos.css, imagenes/ y sql/base_datos.sql para que la práctica
esté completa y funcione tal como la pide la rúbrica.

## Base de datos

- **categorias**: id_categoria (INT 8, PK), descripcion (VARCHAR 30)
- **productos**: id_producto (INT 11, PK), nombre (VARCHAR 30),
  precio (DOUBLE), stock (INT 100), foto_p (VARCHAR 100),
  categoria_id (INT 11, FK a categorias.id_categoria,
  ON DELETE RESTRICT, ON UPDATE CASCADE)

## Cómo instalarlo (en tu computadora)

1. Enciende **Apache y MySQL** en el panel de XAMPP.
2. Copia la carpeta **AVS_03_04_01** dentro de `C:\xampp\htdocs\`.
3. En phpMyAdmin (http://localhost/phpmyadmin), ve a **Importar**,
   elige `sql/base_datos.sql` y pulsa **Continuar**. Esto crea la
   base AVS_03_04_01 con sus dos tablas y 3 productos de ejemplo.
4. Abre en el navegador: http://localhost/AVS_03_04_01/index.php

## Cómo probarlo

1. **Insertar**: Menú → Insertar producto, llena el formulario
   (con foto) y guarda. Debe salir "Producto insertado con éxito".
2. **Listar**: Menú → Lista de productos. Se ven todos con su foto.
3. **Actualizar**: en la lista, pulsa Actualizar en un producto,
   cambia un dato y guarda. Debe salir "Producto actualizado con éxito".
4. **Borrar**: en la lista, pulsa Borrar y confirma. Debe salir
   "Producto borrado con éxito" y el producto ya no aparece.

## Notas

- La conexión usa PDO con consultas preparadas (ver Producto.php).
- Las fotos se guardan en `imagenes/` con un nombre único.
- Solo se aceptan fotos jpg, jpeg, png o webp de máximo 2 MB.
- En XAMPP el usuario de MySQL es `root` sin contraseña. Si tu
  MySQL tiene contraseña, cámbiala en `conexion.php`.
