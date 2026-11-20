<?php
// conexion.php
// Conexion a la base de datos con PDO.
// En XAMPP el usuario es root y la contrasena esta vacia por defecto.
// Si tu MySQL tiene contrasena, cambiala en $pass.

$host = 'localhost';
$db   = 'AVS_03_04_01';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    // PDO es la forma segura de conectar: permite consultas preparadas.
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $pass
    );
    // Que PDO avise con excepciones cuando algo falle.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si no conecta, se muestra el error y se detiene la pagina.
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}
