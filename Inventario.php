<?php
    session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="CSS/Inventario.css">
        <title>Inventario</title>
        <link rel="icon" href="MEDIA/warehouse-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
        <form action="Inventario.php" method="POST">
            <input type="submit" name="valor"  value="<-" class="REGRESO">
        </form>
        <img class="logo" src="MEDIA/FullCleanLogo.jfif">
            <div class="perfil">
                <img src="MEDIA/user.png" alt="Imagen del menú" width="50" height="50">
                <div class="perfil-content">
                    <a href="Perfil.php">Perfil</a>
                    <a href="Index.html">Cerrar Sesión</a>

                </div>
            </div>
        
        </div>
        <div class="barra-divisora"></div>
        <div class="container">
            <div class="menu">
                <!-- Contenido del menú -->
                <button onclick="window.location.href='AgregarInventario.php'">Agregar</button>
                <button onclick="window.location.href='EliminarInventario.php'">Eliminar</button>
                <button onclick="window.location.href='ActualizarInventario.php'">Actualizar</button>
                <button onclick="window.location.href='ProductosDesactivados.php'">Desactivados</button>
                
            </div>
            <div class="content">
                <!-- Contenido principal -->
                <?php include 'MostrarCuadros.php'; ?>
            </div>
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