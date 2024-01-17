<html>
    <head>

        <link rel="stylesheet" href="CSS/MenuAdmin.css">
        <link rel="stylesheet" href="CSS/Inventario.css">
        <title>Desactivar Producto</title>
        <link rel="icon" href="MEDIA/square-xmark-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="Inventario.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="barra-divisora"></div>
    
    <form action="EliminarInventario.php" method="POST">
        <tr>
            <td><input type="text" name="id" placeholder="COLOQUE EL ID DEL PRODUCTO"></td>
            <td><input type="submit"></td>
        </tr>
    </form>
    <div class="content">
                <?php include 'MostrarCuadros.php'; ?>
            </div>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $id=$_POST['id'];
        $consulta ="UPDATE `tinventario` SET `Estado`='0' WHERE ID = $id";
        $resultado=mysqli_query($conn,$consulta); 
      }
      
      
}    
?>