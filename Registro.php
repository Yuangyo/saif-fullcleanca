<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/general.css">
        <link rel="stylesheet" href="CSS/Registro.css">
        <title>Registrarse</title>
        <link rel="icon" href="MEDIA/house-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
            <a href="Index.html"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        
        <div class="form-container">  
            <form action="Registro.php" method="POST">
                <tr>
                    <td><p>Nombre</p><input type="text" name="nombre" placeholder="Nombre" REQUIRED></td>
                    <td><p>Apellido</p><input type="text" name="apellido" placeholder="Apellido" REQUIRED></td>
                    <td><p>Cedula</p><input type="text" name="ci" placeholder="Cedula" REQUIRED></td>
                    <td><p>Email</p><input type="email" name="correo" placeholder="Correo Electronico" REQUIRED></td>
                    <td><p>Contraseña</p><input type="pass" name="pass" placeholder="Contrasenia" REQUIRED></td>
                    <td><p>Repita Contraseña</p><input type="pass" name="repass" placeholder="Repetir Contrasenia" REQUIRED></td>
                    <td><p>Pregunta de Seguridad</p>
                        <select name="Pregunta">
                            <option value="1">Cual fue el nombre de tu amigo de la infancia</option>
                            <option value="2">Cual es el apellido materno de tu padre</option>
                            <option value="3">Cual fue el nombre de tu primera mascota</option>
                            <option value="4">En que hospital naciste</option>
                        </select>
                    </td>
                    <td><p>Respuesta</p><input type="text" name="respuesta" placeholder="Respuesta" REQUIRED></td>
                    <td><input type="submit" name="enviar" id="open"></td>
                </tr>     
            </form>
        </div>
        
        <div id="popup" style="display: none;">
            SOY UN POPUP
        </div>

    </body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $name=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $ci=$_POST['ci'];               //Este campo no se puede repetir
        $email=$_POST['correo'];        //Validar que este no exista en la bd
        $pass=$_POST['pass'];           /*Debo validar que el pass y el repeat pass sean iguales */
        $repass=$_POST['repass'];
        $pregunta=$_POST['Pregunta'];
        $respuesta=$_POST['respuesta'];


        //Cual es la logica detras de esta operacion? Bueno, basicamente se piensa usar el prefijo numerico (Puede ser un numero del 1 al 4) concatenado a la respuesta de la pregunta, de esa forma cuando se va a tratar en el login con la pregunta de seguridad, se separa el prefijo de la pregunta y se puede obtener tanto la pregunta como la respuesta
        $combinacion = $pregunta.$respuesta;

        //Validacion que las contranias coincidan
        if ($pass <> $repass){
            echo 'Las contrasenias no coinciden';
        } else {
            //aca voy a validar si existe la cedula en la bd
            $sql = "SELECT * FROM tuser WHERE CI = '$ci'";
            $result = $conn->query($sql);
            $sqlCorreo = "SELECT * FROM tuser WHERE Email = '$email'";
            $resultCorreo = $conn->query($sqlCorreo);

            //si el numero es mayor a 0, quiere decir que si existe
            if ($result->num_rows > 0 or $resultCorreo->num_rows > 0) {
                echo 'ESTE VALOR YA EXISTE EN LA BD';
            } else {
                $consulta ="INSERT INTO `tpreaprobados`(`CI`, `Nombre`, `Apellido`, `Email`, `Password`, `Respuesta_Seguridad`, `Rango`, `Estado`) VALUES ('$ci','$name','$apellido','$email','$pass','$combinacion','1','1');";
                $resultado=mysqli_query($conn,$consulta);
                echo "USUARIO INSERTADO CON EXITO";
                
            }
        }    
    } 
    }     
?>