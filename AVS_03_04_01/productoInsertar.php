<?php
// productoInsertar.php
// Vista: formulario para insertar un producto nuevo.
// Las categorias se leen de la base de datos para llenar el <select>.
require_once 'conexion.php';
require_once 'Producto.php';

$producto = new Producto($pdo);
$categorias = $producto->listarCategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar producto - AVS.03.04.01</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Insertar producto</h1>
    <p>AVS.03.04.01 &middot; Gestión de productos</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="productoInsertar.php">Insertar producto</a>
    <a href="productoLista.php">Lista de productos</a>
</nav>

<main>
    <h2>Datos del producto nuevo</h2>

    <!-- enctype es obligatorio para poder subir la foto -->
    <form action="productoCont.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="insertar">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" maxlength="30" required>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0" required>

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" step="1" min="0" required>

        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" name="categoria_id" required>
            <option value="">Elige una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id_categoria']; ?>">
                    <?php echo htmlspecialchars($categoria['descripcion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="foto">Foto del producto</label>
        <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp" required>

        <button type="submit">Guardar producto</button>
        <a class="boton boton-secundario" href="productoLista.php">Cancelar</a>
    </form>
</main>
</body>
</html>
