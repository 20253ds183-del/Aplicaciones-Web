<?php
// Producto.php
// Modelo: aqui va todo lo que habla con la base de datos.
// Cada funcion usa consultas preparadas, asi ningun dato del
// formulario se pega directo en el SQL (eso evita inyeccion SQL).

class Producto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Lista todos los productos con el nombre de su categoria.
    // El JOIN trae la descripcion en vez de solo el id.
    public function listar()
    {
        $sql = "SELECT p.id_producto, p.nombre, p.precio, p.stock,
                       p.foto_p, p.categoria_id, c.descripcion AS categoria
                FROM productos p
                INNER JOIN categorias c ON p.categoria_id = c.id_categoria
                ORDER BY p.id_producto ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista las categorias para llenar el <select> del formulario.
    public function listarCategorias()
    {
        $sql = "SELECT id_categoria, descripcion FROM categorias ORDER BY descripcion ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca un producto por su id, para llenar el formulario de actualizar.
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserta un producto nuevo. Devuelve true si se guardo.
    public function insertar($nombre, $precio, $stock, $foto, $categoria_id)
    {
        $sql = "INSERT INTO productos (nombre, precio, stock, foto_p, categoria_id)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $precio, $stock, $foto, $categoria_id]);
    }

    // Actualiza los datos de un producto que ya existe.
    public function actualizar($id, $nombre, $precio, $stock, $foto, $categoria_id)
    {
        $sql = "UPDATE productos
                SET nombre = ?, precio = ?, stock = ?, foto_p = ?, categoria_id = ?
                WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $precio, $stock, $foto, $categoria_id, $id]);
    }

    // Borra un producto por su id.
    public function eliminar($id)
    {
        $sql = "DELETE FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
