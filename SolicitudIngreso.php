<?php
	$conex=mysqli_connect("localhost","root","","dbfullclean");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="CSS/SolicitudesIngreso.css">
	<title>Solicitudes Ingreso</title>
</head>
<body>
        <div class="logo-container">
		<a href="MenuAdmin.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
            <div class="menu">
                <img src="MEDIA/user.png" alt="Imagen del menú" width="50" height="50">
                <div class="menu-content">
                    <a href="Perfil.php">Perfil</a>
                    <a href="Index.html">Cerrar Sesión</a>

                </div>
            </div>   
        </div>
		<div class="barra-divisora"></div>
    <div class="Contenedor">
	<table border="1">	
		<tr>
			<td>CI</td>
			<td>Nombre</td>
			<td>Apellido</td>
			<td>Email</td>
            <td>Operacion sobre usuario</td>
		</tr>
		<?php
			$sql="SELECT * from tpreaprobados";
			$result=mysqli_query($conex,$sql);

			while ($mostrar=mysqli_fetch_array($result)) {
		?>

		<tr>
			<td><?php echo $mostrar['CI']?></td>
			<td><?php echo $mostrar['Nombre']?></td>
			<td><?php echo $mostrar['Apellido']?></td>
			<td><?php echo $mostrar['Email']?></td>
            <td>
                <form action="SolicitudIngreso.php" method="post">
                    <input type="hidden" name="CI" value="<?php echo $mostrar['CI']; ?>">
                    <button onclick="window.location.reload();" type="submit" name="operacion" value="SI">SI</button>
                    <button onclick="window.location.reload();" type="submit" name="operacion" value="NO">NO</button>
                </form>
            </td>
		</tr>
		<?php 
			}
		?>
	</table>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
		$ci = $_POST["CI"];
		$operacion = $_POST["operacion"];
		if ($operacion === "SI") {
			$sql="SELECT * from tpreaprobados WHERE CI = $ci";
			$result=mysqli_query($conex,$sql);
			$asignar=mysqli_fetch_array($result);
			// Acciones correspondientes a la operación "SI" para el usuario con CI $ci
			$nombre = $asignar['Nombre'];
			$Apellido = $asignar['Apellido'];
			$Password = $asignar['Password'];
			$Email = $asignar['Email'];
			$Respuesta_Seguridad = $asignar['Respuesta_Seguridad'];
			$Rango = 1;
			$Estado = 1;
			$consulta = "INSERT INTO `tuser`(`CI`, `Nombre`, `Apellido`, `Email`, `Password`, `Respuesta_Seguridad`, `Rango`, `Estado`) VALUES ('$ci','$nombre','$Apellido','$Email','$Password','$Respuesta_Seguridad','$Rango','$Estado');";
			$resultado=mysqli_query($conn,$consulta);
			$consultaDelete = "DELETE FROM `tpreaprobados` WHERE CI = $ci";
			$resultadoDelete=mysqli_query($conn,$consultaDelete);

		} elseif ($operacion === "NO") {
			// Acciones correspondientes a la operación "NO" para el usuario con CI $ci
			$consulta = "DELETE FROM `tpreaprobados` WHERE CI = $ci";
			$resultado=mysqli_query($conn,$consulta);
		}
	}
}	
?>