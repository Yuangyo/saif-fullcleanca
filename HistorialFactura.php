<?php
	$conex=mysqli_connect("localhost","root","","dbfullclean");
?>
<html>
    <head>

        <link rel="stylesheet" href="CSS/HistorialFactura.css">

        <title>Menu Facturacion</title>
        <link rel="icon" href="MEDIA/comments-dollar-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="MenuUser.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="menu">
                <img src="MEDIA/user.png" alt="Imagen del menú" width="50" height="50">
                <div class="menu-content">
                    <a href="Perfil.php">Perfil</a>
                    <a href="Index.html">Cerrar Sesión</a>

                </div>
            </div>   
        <div class="barra-divisora"></div>
        <div class="contenido">
            <form action="HistorialFactura.php" method="post">
                <input type="text" name="id">
                <input type="submit">
            </form>
        </div>
    <div class="PRODUCTOS">
        <div class="Factuas">
            <table border="1">	
                <tr>
                    <td>ID FACTURA</td>
                    <td>FECHA EMISION</td>
                    <td>CLIENTE</td>
                    <td>CI CLIENTE</td>
                    <td>EMISOR</td>
                </tr>
                <?php
                    $sql="SELECT * from tfacturas";
                    $result=mysqli_query($conex,$sql);

                    while ($mostrar=mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td><?php echo $mostrar['ID_Factura']?></td>
                    <td><?php echo $mostrar['Fecha_Emision']?></td>
                    <td><?php echo $mostrar['Cliente']?></td>
                    <td><?php echo $mostrar['Cedula_Cliente']?></td>
                    <td><?php echo $mostrar['Emisor']?></td>
                </tr>
                <?php 
                    }
                ?>
            </table>
        </div>
        <div class="Elementos">
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
                            echo "<p>ID PRODUCTO: " . $row["ID_Producto"] . "</p>";
                            echo "<p>NOMBRE: " . $row["Nombre"] . "</p>";
                            echo "<p>CANTIDAD: " . $row["cantidad"] . "</p>";
                            echo "<p>Precio Unitario: " . $row["PrecioUnitario"] . "</p>";
                            echo "<p>Impuesto Aplicado: " . $row["Impuesto"] . "</p>";
                            echo "<p>Precio Total: " . $row["PrecioTotal"] . "</p>";

                        echo "</div>";
                    }
                } else {
                    echo "0 resultados";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
                }
            ?>  
        </div>
    </div>
    </body>
</html>        