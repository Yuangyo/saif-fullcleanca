<html>
    <head>

        <link rel="stylesheet" href="CSS/MenuAdmin.css">
        <link rel="stylesheet" href="CSS/Inventario.css">
        <title>Actualizar Producto</title>
        <link rel="icon" href="MEDIA/pen-to-square-solid.svg" type="jpg" sizes="16px">
    </head>
    </head>
    <body>
        <div class="logo-container">
        <a href="Inventario.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
    <div>
    <form action="ActualizarInventario.php" method="POST">
        <tr>
            <td><label for="">ID DEL PRODUCTO</label><input type="text" name="id" placeholder="COLOQUE EL ID DEL PRODUCTO"></td>
            <td><label for="">Nombre</label><input type="text" name="nombre" placeholder="Nombre" REQUIRED></td>
            <td><label for="">Cantidad Actual</label><input type="number" name="cantidad" placeholder="Cantidad" REQUIRED></td>
            <td><label for="">Descripcion</label><input type="text" name="descripcion" placeholder="Descripcion" REQUIRED></td>
            <td><label for="">Precio</label><input type="number" name="precio" placeholder="Precio" REQUIRED></td>   
            <td><input type="submit"></td>
        </tr>   
    </form>
    </div>
    <div class="content">
                <?php include 'MostrarCuadros.php'; ?>
            </div>
    </body>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $cantidad=$_POST['cantidad'];
        $descripcion=$_POST['descripcion'];
        $precio=$_POST['precio'];

        $consulta ="UPDATE `tinventario` SET `Nombre`='$nombre',`Cantidad`='$cantidad',`Precio`='$precio',`Descripcion`='$descripcion' WHERE ID = $id;";
        $resultado=mysqli_query($conn,$consulta);
      }
      
      
}    
?>