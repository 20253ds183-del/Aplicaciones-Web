<?php
// productoCont.php
// Controlador: recibe los datos de los formularios y decide que hacer.
// No muestra HTML, solo procesa y redirige a la lista con un mensaje.
// Acciones: insertar, actualizar y eliminar.

require_once 'conexion.php';
require_once 'Producto.php';

$producto = new Producto($pdo);

// La accion llega por POST en los formularios y por GET al borrar.
$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

// Guarda la foto subida y devuelve solo su nombre de archivo.
// Si no se subio foto, devuelve el nombre que ya tenia (o null).
function subirFoto($fotoActual = null)
{
    // No se eligio archivo nuevo: se queda la foto que ya tenia.
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
        return $fotoActual;
    }

    // Si hubo otro error al subir, no se guarda nada.
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        return $fotoActual;
    }

    // Solo se permiten imagenes, y de maximo 2 MB.
    $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
    $extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $permitidas, true)) {
        return $fotoActual;
    }

    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        return $fotoActual;
    }

    // Nombre unico para que dos fotos no se pisen entre si.
    $nombreNuevo = time() . '_' . basename($_FILES['foto']['name']);
    $destino = __DIR__ . '/imagenes/' . $nombreNuevo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
        return $nombreNuevo;
    }

    return $fotoActual;
}

// Datos comunes del formulario. trim quita espacios de mas.
$nombre       = trim($_POST['nombre'] ?? '');
$precio       = $_POST['precio'] ?? '';
$stock        = $_POST['stock'] ?? '';
$categoria_id = $_POST['categoria_id'] ?? '';
$id           = $_POST['id_producto'] ?? $_GET['id'] ?? '';

if ($accion === 'insertar') {
    $foto = subirFoto(null);
    $producto->insertar($nombre, $precio, $stock, $foto, $categoria_id);
    // Mensaje de que se inserto, se muestra en la lista.
    header('Location: productoLista.php?mensaje=insertado');
    exit;
}

if ($accion === 'actualizar') {
    // Si no se subio foto nueva, se conserva la anterior.
    $fotoActual = $_POST['foto_actual'] ?? null;
    $foto = subirFoto($fotoActual);
    $producto->actualizar($id, $nombre, $precio, $stock, $foto, $categoria_id);
    header('Location: productoLista.php?mensaje=actualizado');
    exit;
}

if ($accion === 'eliminar') {
    // Antes de borrar, se busca la foto para borrar el archivo tambien.
    $dato = $producto->buscarPorId($id);
    $producto->eliminar($id);

    if ($dato && !empty($dato['foto_p'])) {
        $rutaFoto = __DIR__ . '/imagenes/' . basename($dato['foto_p']);
        if (file_exists($rutaFoto)) {
            unlink($rutaFoto);
        }
    }

    header('Location: productoLista.php?mensaje=eliminado');
    exit;
}

// Si no llego ninguna accion valida, se regresa a la lista.
header('Location: productoLista.php');
exit;
