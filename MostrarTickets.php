<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost","root","","dbfullclean");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT * FROM ttickets";
$result = $conn->query($sql);

// Mostrar los datos en cuadros
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='cuadro'>";
        echo "<p>ID: " . $row["ID"] . "</p>";
        echo "<p>NOMBRE: " . $row["Autor"] . "</p>";
        echo "<p>ASUNTO: " . $row["Asunto"] . "</p>";
        echo "<p>FECHA: " . $row["Fecha"] . "</p>";
        echo "<p>DESCRIPCION: " . $row["Cuerpo"] . "</p>";
        echo "</div>";

        
    }
} else {
    echo "0 resultados";
}



$conn->close();
?>
