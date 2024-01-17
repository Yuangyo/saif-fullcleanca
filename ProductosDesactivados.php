<html>
    <head>

        <link rel="stylesheet" href="CSS/Desactivados.css">
        <title>Productos Desctivados</title>
        <link rel="icon" href="MEDIA/tag-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="Inventario.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
        <h1>PRODUCTOS DESACTIVADOS</h1>
        <div class="content">
        <?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost","root","","dbfullclean");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la base de datos
$sql = "SELECT * FROM tinventario WHERE `Estado` = 0";
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
        </div>
    </body>
</html>