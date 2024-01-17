<html>
    <head>
        <link rel="stylesheet" href="CSS/MenuAdmin.css">
        <link rel="stylesheet" href="CSS/Login.css">
        <title>Generar Factura</title>
        <link rel="icon" href="MEDIA/file-invoice-dollar-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="MenuUser.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
        <div class="productos">
            <form method="POST" action="GenerarFactura.php">
                <tr>
                    <td>
                        <label>Producto</label>
                        <select name="nombre">
                            <?php
                                $conex=mysqli_connect("localhost","root","","dbfullclean");
                                $seleccion = "SELECT * FROM `tinventario` WHERE `Estado` = 1";
                                $resultado = mysqli_query($conex,$seleccion);
                                while($valores = mysqli_fetch_array($resultado)){
                                    echo '<option value = "'.$valores['Nombre'].','.$valores['ID'].'">'.$valores['Nombre'].'</option>';
                                }    
                            ?>
                        </select>
                    </td>
                    <td><label>Cantidad</label><input type="number" name="cantidad" placeholder="Cantidad" REQUIRED></td>
                    <td>
                        <label>Impuesto Total Aplicado</label>
                        <select name="impuesto">
                            <option value ="12">12%</option>
                            <option value ="16">16%</option>
                            <option value ="22">22%</option>
                        </select>
                    </td>
                    
                    <td><input type="submit" name="Enviar" id="Enviar" value="ENVIAR"></td>
                </tr>    
            </form>
        </div>
        <div class="historial">
            <h1>PRODUCTOS</h1>
            <div class="historial/productos">
            <table border="1">
                <tr>
                    <td>Nombre</td>
                    <td>ID en Factura</td>
                    <td>Cantidad</td>
                    <td>PRECIO UNITARIO</td>
                    <td>Precio Total</td>
                    <td>Impuesto Aplicado</td>
                    <td>PULSE PARA ELIMINAR</td>
                </tr>
                <?php
                    $conex=mysqli_connect("localhost","root","","dbfullclean");
                    $sql="SELECT * FROM `tbancoproductos` ";
                    $result=mysqli_query($conex,$sql);

                    while ($mostrar=mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td><?php echo $mostrar['Nombre']?></td>
                    <td><?php echo $mostrar['ID_Producto']?></td>
                    <td><?php echo $mostrar['cantidad']?></td>
                    <td><?php echo $mostrar['precioUnitario']?></td>
                    <td><?php echo $mostrar['precioTotal']?></td>
                    <td><?php echo $mostrar['impuesto']. "%"?></td>
                    <td>
                        <form action="EliminarProducto.php" method="post">
                            <input type="hidden" name="Eliminar" value="<?php echo $mostrar['ID_Producto']; ?>">
                            <button onclick="window.location.reload();" type="submit" name="operacion" value="ELIMINAR">X</button>
                        </form>
                    </td>
                </tr>
                <?php 
			    }
		        ?>
            </table>    
            </div>
            <div>
                <button><a href="TerminarFactura.php" >TERMINAR</a></button>
            </div>
        </div>
    </body>
</html>


<?php

function obtenerPrecio($id){
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    $Validacion="SELECT `Precio` FROM `tinventario` WHERE `ID` = $id";
    $query= mysqli_query($conn,$Validacion);
    $fila = mysqli_fetch_row($query);
    $consulta = $fila[0];;
    return $consulta;
}


function porcentaje($porcentaje,$valor){
    $porcentaje = (int)$porcentaje;
    $valor = $valor * (1 + $porcentaje / 100);
    return $valor;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $valores = explode(",", $_POST['nombre']);
        $nombre = $valores[0];
        $idProducto = $valores[1];
        $cantidad = $_POST['cantidad'];
        $cantidad = intval($cantidad);
        $precioUnitario = obtenerPrecio($idProducto);
        
        $impuesto = $_POST['impuesto'];
        $precioTotal = ($precioUnitario * $cantidad);
        $precioFinal = porcentaje($impuesto,$precioTotal);
        $validar="SELECT `Cantidad` FROM `tinventario` WHERE `ID` = $idProducto";
        $consulta= mysqli_query($conn,$validar);
        $fila = mysqli_fetch_row($consulta);
        $consulta = $fila[0];
       
        $operacion = $consulta - $cantidad;
        if ($operacion < 0) {
            echo "No hay suficientes productos en stock";
        }else {
            $insertar = "INSERT INTO `tbancoproductos`( `Nombre`, `cantidad`, `precioUnitario`, `impuesto`, `precioTotal`) VALUES ('$nombre','$cantidad','$precioUnitario','$impuesto','$precioFinal');";
            $resultadoInsertar = mysqli_query($conn,$insertar);
            $actualizar = "UPDATE `tinventario` SET `Cantidad`='$operacion' WHERE `ID` = $idProducto";
            $consulta= mysqli_query($conn,$actualizar);

        }
        
        
    }
}     

?>