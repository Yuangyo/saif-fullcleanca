<html>
    <head>
        <title>Estado Usuarios</title>
        <link rel="icon" href="MEDIA/users-gear-solid.svg" type="jpg" sizes="16px">
        <link rel="stylesheet" href="CSS/EstadoUser.css">
        <script>
      function actualizar() {
        $("#contenido").load("EstadoUser.php");
      }
    </script>
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
        <center><h1>AJUSTAR ESTADO USUARIO</h1></center>
        <div class="contenido">
            <?php
                // Conexión a la base de datos
                $conn = mysqli_connect("localhost","root","","dbfullclean");

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para obtener los datos de la base de datos
                $sql = "SELECT * FROM tuser";
                $result = $conn->query($sql);

                // Mostrar los datos en cuadros
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='cuadro'>";
                        echo "<p>CI: " . $row["CI"] . "</p>";
                        echo "<p>NOMBRE: " . $row["Nombre"] . "</p>";
                        echo "<p>APELLIDO: " . $row["Apellido"] . "</p>";
                        echo "<p>EMAIL: " . $row["Email"] . "</p>";
                        echo "<p>RANGO: " . $row["Rango"] . "</p>";
                        echo "<p>Estado: " . $row["Estado"] . "</p>";
                        ?>
                        <form action="EstadoUser.php" method="POST">
                            <input type="hidden" name="CI" value="<?php echo $row['CI']; ?>">
                            <select name="Estado">
                                <option value="1">Usuario Regular</option>
                                <option value="2">Administrador</option>
                                <option value="3">Desactivar</option>
                                <option value="4">Activar Usuario</option>
                            </select>
                            <button type="submit">ACCIONAR</button>
                        </form>
                        <?php echo "</div>";
                        
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cedula = $_POST['CI'];
        $conn = mysqli_connect("localhost","root","","dbfullclean");
        if (!$conn) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
            $valor = $_POST['Estado'];
            if ($valor == 1) {
                $sql = "UPDATE `tuser` SET `Rango`='1' where  CI = $cedula;";
                $consulta=mysqli_query($conn,$sql);
            } elseif ($valor == 2) {
                $sql = "UPDATE `tuser` SET `Rango`='2' where  CI = $cedula;";
                $consulta=mysqli_query($conn,$sql);
            } elseif ($valor == 3){
                $sql = "UPDATE `tuser` SET `Estado`='0' where  CI = $cedula;";
                $consulta=mysqli_query($conn,$sql);
            } elseif ($valor == 4){
                $sql = "UPDATE `tuser` SET `Estado`='1' where  CI = $cedula;";
                $consulta=mysqli_query($conn,$sql);
            }
        }
        actualizar();
    }


?>