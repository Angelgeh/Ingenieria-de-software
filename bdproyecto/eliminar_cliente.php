<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_cli'])) {
        $id_cli = $_POST['id_cli'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM cliente WHERE id_cli = :id_cli");
            $stmt->bindParam(':id_cli', $id_cli, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Cliente eliminado correctamente.";
            } else {
                echo "No se encontró un cliente con el ID proporcionado: " . $_POST['id_cli'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de cliente válido.";
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
        <a href="cliente.html">&lt; Volver al Menú</a>
        <h1>Eliminar Cliente</h1>
    </header>
    
    <form method="post">
        <label for="id_cli">ID del Cliente a Eliminar:</label>
        <input type="text" id="id_cli" name="id_cli">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
