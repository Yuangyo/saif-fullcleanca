<html>
    <head>
        <link rel="stylesheet" href="CSS/MenuAdmin.css">
        <link rel="stylesheet" href="CSS/Login.css">
        <title>Agregar Cliente</title>
        <link rel="icon" href="MEDIA/file-invoice-dollar-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="MenuUser.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
        <div class="contenido">
            <form method="POST" action="TerminarFactura.php">
                <tr>
                    <td><label>Ingrese el nombre del cliente</label><input type="text" name = "nombreCliente"></td>
                    <td><label>Ingrese la cedula del cliente</label><input type = "number" name = "Cedula"></td>
                    <td><input type = "submit"></td>
                </tr>
            </form>
        </div>
    </body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = mysqli_connect("localhost","root","","dbfullclean");
        if (!$conn) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
        }else{
            //EXPLICACION DE ESTA PARTE DEL CODIGO
            //Inicio sesion
            //Primero que todo, inserto en la base de datos la factura
            session_start();
            $var = $_SESSION['USER'];
            $cliente = $_POST['nombreCliente'];
            $cedula = $_POST['Cedula'];
            $fecha = date("Y-m-d");
            $INSERT = "INSERT INTO `tfacturas`(`Fecha_Emision`, `Cliente`, `Cedula_Cliente`, `Emisor`) VALUES ('$fecha','$cliente','$cedula','$var');";
            $sql =mysqli_query($conn,$INSERT);

            //Obtengo el ultimo registro de mi tabla factura que es a la factura a la cual le voy a encasquetar estos productos
            $Ultimoregistro = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tfacturas` ORDER BY ID_Factura DESC LIMIT 1"));
            $UltimoID = $Ultimoregistro["ID_Factura"];


            //Ahora voy a pasar los productos de una tabla a otra, ya que la primera es auxiliar y la segunda contiene todos los productos
            // Obtención de los registros de la tabla origen
            
            $sql="SELECT * FROM `tbancoproductos` ";
            $result=mysqli_query($conn,$sql);

            while ($registro=mysqli_fetch_array($result)) {
                $id = $registro["ID_Producto"];
                $nombre = $registro["Nombre"];
                $Cantidad = $registro["cantidad"];
                $precioUnitario = $registro["precioUnitario"];
                $impuesto = $registro["impuesto"];
                $precioTotal = $registro["precioTotal"];

                // Inserción del registro en la tabla destino
                $insercionEnTabla= "INSERT INTO `tproductosfactura`(`ID_Relacionado`, `ID_Producto`, `Nombre`, `cantidad`, `PrecioUnitario`, `Impuesto`, `PrecioTotal`) VALUES ('$UltimoID','$id','$nombre','$Cantidad','$precioUnitario','$impuesto','$precioTotal');";
                $consulta = mysqli_query($conn, $insercionEnTabla);
            }
        }


            // Iteración sobre los registros
           /*
           $registros = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `tbancoproductos`"));
           foreach ($registros as $registro) {

                // Obtención de los datos del registro
                $id = $registro["ID_Producto"];
                $nombre = $registro["Nombre"];
                $Cantidad = $registro["cantidad"];
                $precioUnitario = $registro["precioUnitario"];
                $impuesto = $registro["impuesto"];
                $precioTotal = $registro["precioTotal"];

                // Inserción del registro en la tabla destino
                $insercionEnTabla= "INSERT INTO `tproductosfactura`(`ID_Relacionado`, `ID_Producto`, `Nombre`, `cantidad`, `PrecioUnitario`, `Impuesto`, `PrecioTotal`) VALUES ('$UltimoID','$id','$nombre','$Cantidad','$precioUnitario','$impuesto','$precioTotal');";
                $consulta = mysqli_query($conexion, $insercionEnTabla);
            }*/

            
            //Una vez insertado, agarro esa tabla y la borro
            $borrar = "DELETE FROM `tbancoproductos`;";
            $consultaBorrar = mysqli_query($conn, $borrar);
            header('Location: PreviewFactura.php');
            
                
        }
    



?>