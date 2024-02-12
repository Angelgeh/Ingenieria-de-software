<?php
// Verificar si se ha enviado un ID para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id_prod'])) {
        $id_prod = $_POST['id_prod'];

        // Realizar la conexión a la base de datos (reemplaza con tus propias credenciales)
        $host = 'localhost';
        $dbname = 'proyecto';
        $user = 'postgres';
        $password = 'Anmeca130923';
        try {
            $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar y ejecutar la consulta de eliminación
            $stmt = $conn->prepare("DELETE FROM producto WHERE id_prod = :id_prod");
            $stmt->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
            $stmt->execute();

            echo "Registro eliminado correctamente.";
        } catch (PDOException $e) {
            echo "Error al eliminar el registro: " . $e->getMessage();
        }
    } else {
        echo "Ingrese un ID válido para eliminar.";
    }
}
?>
