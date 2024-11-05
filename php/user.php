<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Usuarios</title>
</head>
<body>
    <?php require('header.php');?>
    <main>
        <?php
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
            $user = $_SESSION['nombre'];
            $type = $_SESSION['tipo'];
            echo "Bienvenido: $user<br>";
        } else {
            // Si no hay una sesión iniciada, entonces...
            echo "La sesion no existe";
        }
        ?>
        <div class="content-user">
            <form class="form-user" action="user_insert.php" method="POST">
                
                <label class="label" for="user">Usuario</label>
                <input class="input" type="text" name="user" id="user" placeholder="Escriba un Usuario" maxlength="15" required/>      
                <label class="label" for="passwd">Contraseña</label>
                <input class="input" type="password" name="password" id="passwd" placeholder="Escriba una Contraseña" maxlength="15" required/>
                <label class="label" for="select">Tipo</label>
                <select class="" name="select" id="select">
                        <option value="none" disabled selected >Elija tipo de Usuario</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>	
                </select>             
                <div class="btns">
                    <button class="btn-blue" type="submit" name="load">Cargar</button>
                    <a href="user_table.php" class="btn-green">Mostrar</a>
                </div>
            </form> 
        </div>
        
    </main>
    
</body>
</html>