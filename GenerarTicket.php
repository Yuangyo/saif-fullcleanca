<html>
    <head>
        <link rel="stylesheet" href="CSS/GenerarTicket.css">
        <link rel="stylesheet" href="CSS/Login.css">
        <title>Generar Ticket</title>
        <link rel="icon" href="MEDIA/ticket-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
        <a href="MenuUser.php"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
            <div class="menu">
                <img src="MEDIA/user.png"  width="50" height="50">
                <div class="menu-content">
                    <a href="Perfil.php">Perfil</a>
                    <a href="Index.html">Cerrar Sesión</a>

                </div>
            </div>   
        </div>
        <div class="barra-divisora"></div>
        <div class="contenido">
            <form action="GenerarTicket.php" method="POST" id="ticketForm">
                <tr>
                    <td><p>Asunto del ticket</p><input type="text" name="asunto" placeholder="asunto" REQUIRED></td>
                    <td><p>Cuerpo del mensaje</p><input type="text" name="mensaje" class="Mensaje" placeholder="mensaje" REQUIRED></td>                    
                    <td><input type="submit" name="enviar" id="enviarBtn"></td>
                </tr>     
            </form>
        </div>

    </body>
</html>

<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $ci =  $_SESSION['USER'];
        $conn = mysqli_connect("localhost","root","","dbfullclean");
        if (!$conn) {
            die("Error al conectar a la base de datos: " . mysqli_connect_error());
          }else{
            $asunto = $_POST["asunto"];
            $mensaje = $_POST["mensaje"];
            $fecha = date('Y-m-d');
            $consulta = "INSERT INTO `ttickets`(`Autor`, `Asunto`, `Fecha`, `Cuerpo`) VALUES ('$ci','$asunto','$fecha','$mensaje');";
            $resultado=mysqli_query($conn,$consulta);
          }
    }      
?>