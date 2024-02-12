<?php
$host = 'localhost';
$dbname = 'proyecto';
$username = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_emp = $_POST['id_emp'];
        $campo = $_POST['campo'];
        $nuevo_valor = $_POST['nuevo_valor'];

        $query = $conn->prepare("UPDATE Empleado SET $campo = :nuevo_valor WHERE id_emp = :id_emp");

        if ($campo === 'nom_emp' || $campo === 'puesto_emp') {
            $query->bindParam(':nuevo_valor', $nuevo_valor);
        } else {
            echo "Campo inválido.";
            exit();
        }

        $query->bindParam(':id_emp', $id_emp);
        $query->execute();

        // Registrar el cambio en el historial
        $historial = $conn->prepare("INSERT INTO HistorialCambiosEmpleado (id_emp, campo_afectado, valor_anterior) 
                                    SELECT id_emp, :campo, $campo FROM Empleado WHERE id_emp = :id_emp");
        $historial->bindParam(':campo', $campo);
        $historial->bindParam(':id_emp', $id_emp);
        $historial->execute();

        echo "El campo '$campo' del empleado con ID $id_emp se actualizó correctamente.";
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
        <a href="empleado.html">&lt; Volver al Menú</a>
        <h1>Actualizar Campo del Empleado</h1>
    </header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="id_emp">ID del Empleado:</label>
        <input type="number" id="id_emp" name="id_emp" required>

        <label for="campo">Campo a Actualizar:</label>
        <select id="campo" name="campo">
            <option value="nom_emp">Nombre</option>
            <option value="puesto_emp">Puesto</option>
            <!-- Si también quieres permitir actualizar el ID, agrega la opción correspondiente -->
            <!--<option value="id_emp">ID</option>-->
        </select>

        <label for="nuevo_valor">Nuevo Valor:</label>
        <input type="text" id="nuevo_valor" name="nuevo_valor" required>

        <input type="submit" value="Actualizar Campo">
    </form>
</body>
</html>
