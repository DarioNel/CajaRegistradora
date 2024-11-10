<?php
// Inicia el buffer
ob_start(); 

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluyo la conexion a la base de datos.
include ('connection.php');

// Si la id que recivo no esta vacia.
if (isset($_GET['id'])){
    $id = trim($_GET['id']); // La almaceno en una variable.
  
    // Realiza la consulta sql, para modificar los datos de la tabla usuario.
    $sql_user = "SELECT * FROM Usuarios
    WHERE Id_usuario = $id";
    
    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql_user);

    if (!$result){
        // Mostrame el siguiente error.
        die("Error en la consulta en la base de datos: " . $conn->connect_error);
    }
    
    if ($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $user = $row['Nombre']; 
        $pass = $row['Clave']; 
        $type = $row['Tipo'];
    }

    if (isset($_POST['modify'])){
        $id = trim($_GET['id']);
        $user = trim($_POST['user']);
        $pass= trim($_POST['password']);
        $type = trim($_POST['category']);
        
        // Realiza la consulta sql, para modificar los datos de la tabla usuarios
        $sql_update_user = "UPDATE Usuarios 
                            SET Nombre = '$user', Clave = '$pass', Tipo = '$type'
                            WHERE Id_usuario = $id";
        //
        $result2 = $conn->query($sql_update_user);

        header("Location: user_table.php");

        if (!$result2){
            // Mostrame el siguiente error.
            die("Error en la consulta en la base de datos: " . $conn->error );
        }
    }    
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Modificar Usuarios</title>
</head>
<body>
    <?php require('header.php');?>
    <main>
        <?php
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
            $user = $_SESSION['nombre'];
            $type = $_SESSION['tipo'];
            echo "Usuario: $type<br>";
            echo "Bienvenido: $user";
        } else {
            // Si no hay una sesión iniciada, entonces...
            echo "ERROR de SESSION";
        }
        ?>
        <div class="content-user">
            <form class="form-user" action="user_modify.php?id=<?php echo $_GET['id'];?>" method="POST">
                <label class="label" for="user">Usuario</label>
                <input class="input" type="text" name="user" id="user" value="<?php echo $user?>" placeholder="Escriba un Usuario" maxlength="15" required/>      
                <label class="label" for="passwd">Contraseña</label>
                <input class="input" type="password" name="password" id="passwd" value="<?php echo $pass?>" placeholder="Escriba una Contraseña" maxlength="15" required/>
                <label class="label" for="select">Tipo</label>
                <select class="" name="category" id="select" value="<?php echo $type?>">
                        <option value="none" disabled selected >Elija tipo de Usuario</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>	
                </select>             
                <div class="btns">    
                    <button class="btn-blue"  type="submit" name="modify">Actualizar</button>
                </div>
            </form> 
        </div>
        
    </main>
    
</body>
</html>