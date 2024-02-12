<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_cli = $_POST['id_cli'];
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        $query = $conn->prepare("UPDATE Cliente SET $campo = :nuevo_valor WHERE id_cli = :id_cli");

        if ($campo === 'nom_cli' || $campo === 'correo' || $campo === 'telefono') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->bindParam(':id_cli', $id_cli);
        $query->execute();

        // Registrar el cambio en el historial
        $historial = $conn->prepare("INSERT INTO HistorialCambiosCliente (id_cli, campo_afectado, valor_anterior) 
                                    SELECT id_cli, :campo, $campo FROM Cliente WHERE id_cli = :id_cli");
        $historial->bindParam(':campo', $campo);
        $historial->bindParam(':id_cli', $id_cli);
        $historial->execute();

        echo "El campo '$campo' del cliente con ID $id_cli se actualizó correctamente.";
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
        <a href="cliente.html">&lt; Volver al Menú</a>
        <h1>Actualizar Campo del Cliente</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_cli">ID del Cliente:</label>
        <input type="number" id="id_cli" name="id_cli" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="nom_cli">Nombre</option>
            <option value="correo">Correo</option>
            <option value="telefono">Teléfono</option>
            <!-- Si también quieres permitir actualizar el ID, agrega la opción correspondiente -->
            <!--<option value="id_cli">ID</option> -->
        </select>

        <label for="nuevo_valor">Nuevo Valor:</label>
        <input type="text" id="nuevo_valor" name="nuevo_valor" required>

        <input type="submit" value="Actualizar Campo">
    </form>
</body>
</html>
