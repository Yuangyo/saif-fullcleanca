<html>
    <head>
        <link rel="stylesheet" href="CSS/perfil.css">
        <title>Perfil</title>
        <link rel="icon" href="MEDIA/user-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
        <form action="Perfil.php" method="POST">
            <input type="submit" name="valor"  value="<-" class="REGRESO">
        </form>
            <a href=".php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div> 
        <div class="barra-divisora"></div>
        <div class="contenido">
        <?php
            // Conexión a la base de datos
            $conn = mysqli_connect("localhost","root","","dbfullclean");
            session_start();
            $ci = $_SESSION['USER'];

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener los datos de la base de datos
            $sql = "SELECT * FROM tuser WHERE CI = $ci";
            $result = $conn->query($sql);

            // Mostrar los datos en cuadros
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='cuadro'>";
                    $direccion_imagen = $row["Imagen"];
                    echo "<img src='$direccion_imagen' width='50' height='50' border='1px solid black'>";
                    echo "<p>CI: " . $row["CI"] . "</p>";
                    echo "<p>NOMBRE: " . $row["Nombre"] . "</p>";
                    echo "<p>APELLIDO: " . $row["Apellido"] . "</p>";
                    echo "<p>EMAIL: " . $row["Email"] . "</p>";
                    echo "<p>RANGO: " . $row["Rango"] . "</p>";
                    echo "<p>Estado: " . $row["Estado"] . "</p>";
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




<?php
function filtrarUsuario($ci){
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    $sql = "SELECT Rango FROM tuser WHERE CI = '$ci'";
    $result = $conn->query($sql);
    $valor = $result->fetch_assoc()["Rango"];
    if ($valor == '1'){
        $respuesta = 1;
    } else {
        $respuesta = 2;
    }
    $conn->close();
    return $respuesta;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $ci = $_SESSION['USER'];
        $filtro = filtrarUsuario($ci);

        if($filtro == 1){
            echo "<script> 
                    window.location.href = 'MenuUser.php';
                </script>";
        }else{
            echo "<script>

                    window.location.href = 'MenuAdmin.php';

            </script>";
        }
      }
}

?>