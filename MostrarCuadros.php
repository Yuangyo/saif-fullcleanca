<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost","root","","dbfullclean");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la base de datos
$sql = "SELECT * FROM tinventario WHERE `Estado` = 1";
$result = $conn->query($sql);

// Mostrar los datos en cuadros
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='cuadro'>";
        $direccion_imagen = $row["Imagen"];
        echo "<img src='$direccion_imagen' width='300' height='175' border='1px solid black'>";
        echo "<p>ID: " . $row["ID"] . "</p>";
        echo "<p>NOMBRE: " . $row["Nombre"] . "</p>";
        echo "<p>CANTIDAD: " . $row["Cantidad"] . "</p>";
        echo "<p>PRECIO: " . $row["Precio"] . "</p>";
        echo "<p>DESCRIPCION: " . $row["Descripcion"] . "</p>";
        echo "</div>";
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
