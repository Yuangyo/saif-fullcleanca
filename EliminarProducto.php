<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $var = $_POST['Eliminar'];
        $consulta = "DELETE FROM `tbancoproductos` WHERE ID_Producto = $var";
		$resultado=mysqli_query($conn,$consulta);
        header('Location: GenerarFactura.php');
    }
}   

?>