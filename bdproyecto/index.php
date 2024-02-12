<?php
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.html'); // Redirigir a login.html si no ha iniciado sesión
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    
    <header>
        <h1>Menú de Usuario</h1>
    </header>
    <nav>
        <ul>
            <li><a href="producto.html">Producto</a></li>
            <li><a href="cliente.html">Cliente</a></li>
            <li><a href="venta.html">Venta</a></li>
            <li><a href="compra.html">Compra</a></li>
            <li><a href="proveedor.html">Proveedor</a></li>
            <li><a href="factura.html">Factura</a></li>
            <li><a href="empleado.html">Empleado</a></li>
        </ul>
    </nav>
    <header>
        <h1 id="name">Metales Herrera y asociados S.A DE C.V</h1>
    </header>

    <footer>
        <p>&copy; 2023 Metales CUCEI</p>
    </footer>
</body>
</html>
