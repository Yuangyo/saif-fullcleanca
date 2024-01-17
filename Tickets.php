<html>
    <head>
        <title>Tickets</title>
        <link rel="icon" href="MEDIA/ticket-solid.svg" type="jpg" sizes="16px">
        <link rel="stylesheet" href="CSS/Tickets.css">
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
        <center><h1>TICKETS GENERADOS POR USUARIOS</h1></center>
        <div class="contenido">
            
            <?php include 'MostrarTickets.php'; ?>
        </div>
    </body>
</html>
