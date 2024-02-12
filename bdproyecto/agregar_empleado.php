<?php
$host = 'localhost';
$dbname = 'proyecto';
$user = 'postgres';
$password = 'Anmeca130923';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_emp = $_POST['id_emp'];
        $nom_emp = $_POST['nom_emp'];
        $puesto_emp = $_POST['puesto_emp'];

        $query = $conn->prepare("INSERT INTO empleado (id_emp, nom_emp, puesto_emp) VALUES (:id_emp, :nom_emp, :puesto_emp)");
        $query->bindParam(':id_emp', $id_emp);
        $query->bindParam(':nom_emp', $nom_emp);
        $query->bindParam(':puesto_emp', $puesto_emp);
        $query->execute();

        echo "Nuevo empleado agregado correctamente.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
