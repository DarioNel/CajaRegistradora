<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Incluyo la conexion a la base de datos.
include ('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Gestión de Usuarios</title>
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
            echo "ERROR de SESSION";
            exit();
        }
        ?>
        <div class="table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th>    
                </tr>
                <?php 
                $sql_user = "SELECT * FROM Usuarios";
                $result = $conn->query($sql_user);
                if (!$result){
                    // Mostrame el siguiente error.
                    die("Error en la consulta en la base de datos: " . $conn->connect_error);
                }
                while($row = $result->fetch_assoc()) {?>  
                <tr>
                    <td><?php echo $row['Id_usuario'];?></td>
                    <td><?php echo $row['Nombre'];?></td>
                    <td><?php echo $row['Clave'];?></td>
                    <td><?php echo $row['Tipo'];?></td>
                    <td>
                        <button class="btn-modi"><a href="user_modify.php?id=<?php echo $row['Id_usuario']?>">Modificar</a></button>
                        <button class="btn-del"><a href="user_delete.php?id=<?php echo $row['Id_usuario']?>">Eliminar</a></button>
                    </td>
                </tr>
                <?php }?>
            </table>    
        </div>
    </main>
    
</body>
</html>