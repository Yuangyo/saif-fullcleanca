<html>
    <head>
        <link rel="stylesheet" href="CSS/general.css">
        <link rel="stylesheet" href="CSS/Login.css">
        <title>Iniciar Sesion</title>
        <link rel="icon" href="MEDIA/house-solid.svg" type="jpg" sizes="16px">
    </head>
    <body>
        <div class="logo-container">
        <a href="Index.html"><img class="logo" src="MEDIA/FullCleanLogo.jfif"></a>
        </div>
        <div class="form-container">
            <form action="Login.php" method="POST">
                <tr>
                    <td><input type="email" name="correo" placeholder="Correo" REQUIRED></td>
                    <td><input type="pass" name="pass" placeholder="Contrasenia" REQUIRED></td>
                    <td><input type="submit"></td>
                </tr>
            </form>
            <a href="Recuperar.php"><label for="">Olvidaste tu contrasenia</label></a>
        </div>
    </body>
</html>

<?php

//Habilita las variables de sesion
session_start();

//Con esta funcion se valida que el usuario sea un admin o no
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

//Validar que el usuario esté activo en la BD
function filtrarActivo($ci){
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    $sql = "SELECT Estado FROM tuser WHERE CI = '$ci'";
    $result = $conn->query($sql);
    $valor = $result->fetch_assoc()["Estado"];
    if ($valor == '1'){
        $respuesta = 1;
    } else {
        $respuesta = 0;
    }
    $conn->close();
    return $respuesta;
}
//Esta linea que esta justo aqui abajo valida que el formulario se haya enviado al menos por primera vez,
//si es cierto, ejecuta el codigo, pero sino es cierto, no va a hacer el codigo de abajo, ya que no se ha
//enviado por lo menos una vez el metodo post a la base de datos y de esta forma te evitas errores al momento de usar el metodo post

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost","root","","dbfullclean");
    if (!$conn) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
      }else{
        $email = $_POST['correo'];
        $pass = $_POST['pass'];
        //Validacion que los datos sean correctos
        $sql = "SELECT * FROM tuser WHERE Email = '$email' AND Password = '$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Estos datos si estan en la BD
            $sql = "SELECT CI FROM tuser WHERE Email = '$email'";
            $result = $conn->query($sql);
            $valor = $result->fetch_assoc()["CI"];
            $_SESSION['USER'] = $valor;
            $filtro = filtrarUsuario($valor);
            $valActivo = filtrarActivo($valor);

            if ($valActivo == 1){
                //FILTRADO EL USUARIO TE LLEVA A UN MENU O A OTRO
                if ($filtro == 1){
                    //1 PARA USUARIO NORMAL
                    header("Location: MenuUser.php");
                    die();
                } else {
                    //2 PARA USUARIO ADMINISTRADOR
                    header("Location: MenuAdmin.php");
                    die();
                }
            } else {
                echo "USUARIO NO ACTIVO EN LA BD, CONSULTE CON EL ADMIN";
            }
        }
      }
      
}    
?>