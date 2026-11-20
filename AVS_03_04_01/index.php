<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de productos - AVS.03.04.01</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Gestión de productos</h1>
    <p>AVS.03.04.01 &middot; Aplicaciones Web &middot; PHP y MySQL con XAMPP</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="productoInsertar.php">Insertar producto</a>
    <a href="productoLista.php">Lista de productos</a>
</nav>

<main>
    <h2>Menú principal</h2>
    <p>Desde aquí se gestionan los productos de la base de datos <strong>AVS_03_04_01</strong>: se pueden insertar productos nuevos, ver la lista completa con su foto y su categoría, actualizar sus datos y borrarlos.</p>

    <div class="tarjetas">
        <div class="tarjeta">
            <h3>Insertar producto</h3>
            <p>Formulario para registrar un producto nuevo con nombre, precio, stock, categoría y foto.</p>
            <a class="boton" href="productoInsertar.php">Insertar</a>
        </div>
        <div class="tarjeta">
            <h3>Lista de productos</h3>
            <p>Tabla con todos los productos, su foto y su categoría. Desde ahí se actualiza o se borra cada uno.</p>
            <a class="boton" href="productoLista.php">Ver lista</a>
        </div>
    </div>

    <h3>¿Cómo funciona?</h3>
    <p>El menú (index.php) es la vista principal. El formulario envía los datos a <strong>productoCont.php</strong>, que decide si insertar, actualizar o borrar. El modelo <strong>Producto.php</strong> es el que habla con MySQL usando consultas preparadas, y la conexión vive en <strong>conexion.php</strong>.</p>
</main>
</body>
</html>
