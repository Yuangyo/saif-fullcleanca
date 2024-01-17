<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$id = $_POST['id'];
// Conexión a la base de datos
$conn = mysqli_connect("localhost","root","","dbfullclean");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la base de datos
$sql="SELECT * FROM `tproductosfactura` WHERE `ID_Relacionado` = $id";
$result = $conn->query($sql);

// Mostrar los datos en cuadros
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='cuadro'>";
        echo "<p>ID: " . $row["ID_Relacionado"] . "</p>";
        echo "<p>NOMBRE: " . $row["ID_Producto"] . "</p>";
        echo "<p>CANTIDAD: " . $row["Nombre"] . "</p>";
        echo "<p>PRECIO: " . $row["cantidad"] . "</p>";
        echo "<p>DESCRIPCION: " . $row["PrecioUnitario"] . "</p>";
        echo "<p>DESCRIPCION: " . $row["Impuesto"] . "</p>";
        echo "<p>DESCRIPCION: " . $row["PrecioTotal"] . "</p>";

        echo "</div>";
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();
}
?>
