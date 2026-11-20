<?php
// productoActualizar.php
// Vista: formulario para actualizar un producto que ya existe.
// Primero busca el producto por su id y llena el formulario con sus datos.
// Si no se elige foto nueva, se conserva la que ya tenia.
require_once 'conexion.php';
require_once 'Producto.php';

$producto = new Producto($pdo);
$categorias = $producto->listarCategorias();

$id = $_GET['id'] ?? '';
$dato = $producto->buscarPorId($id);

// Si el id no existe, se regresa a la lista.
if (!$dato) {
    header('Location: productoLista.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar producto - AVS.03.04.01</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Actualizar producto</h1>
    <p>AVS.03.04.01 &middot; Gestión de productos</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="productoInsertar.php">Insertar producto</a>
    <a href="productoLista.php">Lista de productos</a>
</nav>

<main>
    <h2>Actualizar: <?php echo htmlspecialchars($dato['nombre']); ?></h2>

    <form action="productoCont.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id_producto" value="<?php echo $dato['id_producto']; ?>">
        <input type="hidden" name="foto_actual" value="<?php echo htmlspecialchars($dato['foto_p'] ?? ''); ?>">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" maxlength="30" required
               value="<?php echo htmlspecialchars($dato['nombre']); ?>">

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0" required
               value="<?php echo htmlspecialchars($dato['precio']); ?>">

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" step="1" min="0" required
               value="<?php echo htmlspecialchars($dato['stock']); ?>">

        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" name="categoria_id" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id_categoria']; ?>"
                    <?php echo ($categoria['id_categoria'] == $dato['categoria_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($categoria['descripcion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Foto actual</label>
        <?php if (!empty($dato['foto_p'])): ?>
            <p><img class="foto" src="imagenes/<?php echo htmlspecialchars($dato['foto_p']); ?>" alt="Foto actual"></p>
        <?php else: ?>
            <p>Sin foto.</p>
        <?php endif; ?>

        <label for="foto">Foto nueva (opcional, si no eliges nada se queda la actual)</label>
        <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,.webp">

        <button type="submit">Actualizar producto</button>
        <a class="boton boton-secundario" href="productoLista.php">Cancelar</a>
    </form>
</main>
</body>
</html>
