<?php
// productoLista.php
// Vista: lista de todos los productos con su foto y su categoria.
// Aqui tambien se muestran los mensajes de exito despues de
// insertar, actualizar o borrar, y estan los botones de accion.
require_once 'conexion.php';
require_once 'Producto.php';

$producto = new Producto($pdo);
$productos = $producto->listar();

// Mensaje que llega por la URL (?mensaje=insertado, actualizado o eliminado).
$mensaje = $_GET['mensaje'] ?? '';
$textos = [
    'insertado'   => 'Producto insertado con éxito.',
    'actualizado' => 'Producto actualizado con éxito.',
    'eliminado'   => 'Producto borrado con éxito.',
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de productos - AVS.03.04.01</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Lista de productos</h1>
    <p>AVS.03.04.01 &middot; Gestión de productos</p>
</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="productoInsertar.php">Insertar producto</a>
    <a href="productoLista.php">Lista de productos</a>
</nav>

<main>
    <h2>Todos los productos</h2>

    <?php if (isset($textos[$mensaje])): ?>
        <p class="mensaje"><?php echo $textos[$mensaje]; ?></p>
    <?php endif; ?>

    <p><a class="boton" href="productoInsertar.php">+ Insertar producto nuevo</a></p>

    <?php if (empty($productos)): ?>
        <p>Todavía no hay productos registrados.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?php echo $p['id_producto']; ?></td>
                        <td>
                            <?php if (!empty($p['foto_p'])): ?>
                                <img class="foto" src="imagenes/<?php echo htmlspecialchars($p['foto_p']); ?>"
                                     alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                            <?php else: ?>
                                Sin foto
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($p['categoria']); ?></td>
                        <td>$<?php echo number_format($p['precio'], 2); ?></td>
                        <td><?php echo $p['stock']; ?></td>
                        <td>
                            <a href="productoActualizar.php?id=<?php echo $p['id_producto']; ?>">Actualizar</a>
                            |
                            <a href="productoCont.php?accion=eliminar&amp;id=<?php echo $p['id_producto']; ?>"
                               onclick="return confirm('¿Seguro que quieres borrar este producto?');">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
