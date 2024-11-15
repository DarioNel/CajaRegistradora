<?php
// Inicia el buffer
ob_start(); 
// Inicio una sesion.
session_start();
// Incluyo la conexion a la base de datos.
include ('connection.php');
?>
<?php  
// Verifico si los datos del formulario se enviaron correctamente por el metodo POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es correcto, recupero esos datos y los guardo en una variable usuer y passwd.
    $user = $_POST['user'];
    $passwd = $_POST['passwd'];
    // Realizo la consulta para validar el usuario y contraseña en mi base de datos.
    $sql = "SELECT * FROM Usuarios
              WHERE Nombre = '$user' 
              AND Clave = '$passwd' 
              AND (Tipo ='Administrador' OR Tipo ='Empleado')";
    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql);

    // Verifico si el numero de filas en la base de datos es mayor a cero.
    if ($result->num_rows > 0) {
        // Declaro una variable row y almaceno.
        $row = $result->fetch_assoc();
        // Accedo al elemento donde tengo mi tipo de usuario 'Administrador o Vendedor' y lo almaceno en type
        $type = $row['Tipo'];
        echo "mayor a cero";
        // Declaro una variable sesion llamada nombre, almaceno el usuario. 
        $_SESSION['nombre'] = $user;
        // Declaro una variable sesion llamada tipo, almaceno el tipo de usuario.
        $_SESSION['tipo'] = $type;
        // Declaro una variable sesion llamada id_user, almaceno el Id de mi usuario.
        $_SESSION['id_user'] = $row['Id_usuario'];  

        // Redirigir según el tipo de usuario
        switch ($type) {
            case 'Administrador':
                header("Location: main_admin.php");
                exit();
            case 'Empleado':
                header("Location: main_user.php");
                exit();
            default:
                echo "Tipo de usuario no reconocido.";
            }

    }else {
        // Mostrar error de autenticación
        //echo "ERROR USUARIO O CONTRASEÑA INCORRECTO";
        header("Location: login.php");
        exit();
    }

    // Liberar el resultado de la consulta
    $result->free();
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
