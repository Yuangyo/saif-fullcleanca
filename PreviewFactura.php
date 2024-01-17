<html>
    <head>
        <link rel="stylesheet" href="CSS/MenuAdmin.css">
        <link rel="stylesheet" href="CSS/Login.css">
    </head>
    <body>
        <div class="logo-container">
            <a href="MenuUser.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
        <div class="contenido">
        <table border="1">
                <tr>
                    <td>Nombre</td>
                    <td>ID en Factura</td>
                    <td>Cantidad</td>
                    <td>PRECIO UNITARIO</td>
                    <td>Precio Total</td>
                    <td>Impuesto Aplicado</td>
                </tr>
                <?php
                    session_start();
                    $conex=mysqli_connect("localhost","root","","dbfullclean");
                    $Ultimoregistro = mysqli_fetch_assoc(mysqli_query($conex, "SELECT * FROM `tfacturas` ORDER BY ID_Factura DESC LIMIT 1"));
                    $UltimoID = $Ultimoregistro["ID_Factura"];
                    $_SESSION['ultimoID'] = $UltimoID;
                    ?>
                    <h1>ID FACTURA: </h1><?php echo $UltimoID;
                    $sql="SELECT * FROM `tproductosfactura` WHERE ID_Relacionado = $UltimoID ";
                    $result=mysqli_query($conex,$sql);

                    while ($mostrar=mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td><?php echo $mostrar['Nombre']?></td>
                    <td><?php echo $mostrar['ID_Producto']?></td>
                    <td><?php echo $mostrar['cantidad']?></td>
                    <td><?php echo $mostrar['PrecioUnitario']?></td>
                    <td><?php echo $mostrar['PrecioTotal']?></td>
                    <td><?php echo $mostrar['Impuesto']?></td>
                </tr>
                <?php 
			    }
		        ?>
            </table>    
        </div>
        <div>
            <button><a href="ImprimirFacturaPDF.php" target="_blank">IMPRIMIR A PDF</a></button>
        </div>
    </body>
</html>

