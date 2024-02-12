<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_compra'])) {
        $id_compra = $_POST['id_compra'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM compra WHERE id_compra = :id_compra");
            $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Compra eliminada correctamente.";
            } else {
                echo "No se encontró una compra con el ID proporcionado: " . $_POST['id_compra'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de compra válido.";
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
        <a href="compra.html">&lt; Volver al Menú</a>
        <h1>Eliminar Compra</h1>
    </header>
    
    <form method="post">
        <label for="id_compra">ID de la Compra a Eliminar:</label>
        <input type="text" id="id_compra" name="id_compra">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
