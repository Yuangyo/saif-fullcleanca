<html>
    <head>

        
        <link rel="stylesheet" href="CSS/Inventario.css">
        <link rel="stylesheet" href="CSS/AgregarInventario.css">
        <title>Agregar Producto</title>
        <link rel="icon" href="MEDIA/boxes-stacked-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="Inventario.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
    <div>
    <form action="AgregarInventario.php" method="POST">
        <tr>
            <td><label for="">Nombre</label><input type="text" name="nombre" placeholder="Nombre" REQUIRED></td>
            <td><label for="">Cantidad Actual</label><input type="number" name="cantidad" placeholder="Cantidad" REQUIRED></td>
            <td><label for="">Descripcion</label><input type="text" name="descripcion" placeholder="Descripcion" REQUIRED></td>
            <td><label for="">Precio</label><input type="number" name="precio" placeholder="Precio" REQUIRED></td>
            <td><label for="">Ingrese un URL de google</label><input type="text" name="imagen" placeholder="Imagen"></td>
            <td><input type="submit"></td>
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
        $nombre=$_POST['nombre'];
        $cantidad=$_POST['cantidad'];
        $descripcion=$_POST['descripcion'];
        $precio=$_POST['precio'];
        $imagen=$_POST['imagen'];

        $consulta ="INSERT INTO `tinventario`(`Nombre`, `Cantidad`, `Precio`, `Descripcion`, `Imagen`, `Estado`) VALUES ('$nombre','$cantidad','$precio','$descripcion','$imagen','1');";
        $resultado=mysqli_query($conn,$consulta);
        echo "Su producto ha sido agregado";
      }
      
      
}    
?>