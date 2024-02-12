<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_emp'])) {
        $id_emp = $_POST['id_emp'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $username = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM empleado WHERE id_emp = :id_emp");
            $stmt->bindParam(':id_emp', $id_emp, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Empleado eliminado correctamente.";
            } else {
                echo "No se encontró un empleado con el ID proporcionado: " . $_POST['id_emp'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de empleado válido.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="stilosbusqueda.css">
    <title>Metales Herrera y Asociados S.A DE C.V</title>
</head>
<body>
    <header>
        <a href="empleado.html">&lt; Volver al Menú</a>
        <h1>Eliminar Empleado</h1>
    </header>
    
    <form method="post">
        <label for="id_emp">ID del Empleado a Eliminar:</label>
        <input type="text" id="id_emp" name="id_emp">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
