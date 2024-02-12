<?php
// Datos de conexión a la base de datos (cámbialos por tus propios datos)
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    // Conexión a la base de datos
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se envió un formulario y actualizar el campo seleccionado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_prod = $_POST['id_prod'];
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        // Consulta para actualizar el campo seleccionado del producto
        $query = $conn->prepare("UPDATE Producto SET $campo = :nuevo_valor WHERE id_prod = :id_prod");
        $query->bindParam(':id_prod', $id_prod);

        // Verificar el tipo de campo a actualizar y asignar el valor correspondiente
        if ($campo === 'nom_prod' || $campo === 'precio') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->execute();

        echo "El campo '$campo' del producto con ID $id_prod se actualizó correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stilosbusqueda.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>
    <a href="producto.html">&lt; Volver al Menu</a>
    <h1>Actualizar Producto</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_prod">ID del Producto:</label>
        <input type="number" id="id_prod" name="id_prod" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="nom_prod">Nombre</option>
            <option value="precio">Precio</option>
            <!-- Si también quieres permitir actualizar el ID, agrega la opción correspondiente -->
            <!--<option value="id_prod">ID</option> -->
        </select>

        <label for="nuevo_valor">Nuevo Valor:</label>
        <input type="text" id="nuevo_valor" name="nuevo_valor" required>

        <input type="submit" value="Actualizar Campo">
    </form>
</body>
</html>
