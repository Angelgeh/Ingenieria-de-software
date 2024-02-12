<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_prov'])) {
        $id_prov = $_POST['id_prov'];
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM proveedor WHERE id_prov = :id_prov");
            $stmt->bindParam(':id_prov', $id_prov, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Proveedor eliminado correctamente.";
            } else {
                echo "No se encontró un proveedor con el ID proporcionado: " . $_POST['id_prov'];
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID de proveedor válido.";
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
        <a href="proveedor.html">&lt; Volver al Menú</a>
        <h1>Eliminar Proveedor</h1>
    </header>
    
    <form method="post">
        <label for="id_prov">ID del Proveedor a Eliminar:</label>
        <input type="text" id="id_prov" name="id_prov">
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>
