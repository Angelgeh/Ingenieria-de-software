<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_prov = $_POST['id_prov'];
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        $query = $conn->prepare("UPDATE proveedor SET $campo = :nuevo_valor WHERE id_prov = :id_prov");

        if ($campo === 'nom_prov' || $campo === 'contacto') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->bindParam(':id_prov', $id_prov);
        $query->execute();

        echo "El campo '$campo' del proveedor con ID $id_prov se actualizó correctamente.";
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
        <a href="proveedor.html">&lt; Volver al Menú</a>
        <h1>Actualizar Campo del Proveedor</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_prov">ID del Proveedor:</label>
        <input type="number" id="id_prov" name="id_prov" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="nom_prov">Nombre Proveedor</option>
            <option value="contacto">Contacto</option>
            <!-- Si también quieres permitir actualizar otros campos, agrega las opciones correspondientes -->
        </select>

        <label for="nuevo_valor">Nuevo Valor:</label>
        <input type="text" id="nuevo_valor" name="nuevo_valor" required>

        <input type="submit" value="Actualizar Campo">
    </form>
</body>
</html>
