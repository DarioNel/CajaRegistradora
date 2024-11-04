<?php 
// Incluyo la conexion a la base de datos.
include ('connection.php');

if (isset($_GET['id'])){
    $id = trim($_GET['id']);
  
    // Realiza la consulta sql, para eliminar los datos de la tabla usuarios
    $sql_del_user = "DELETE FROM Usuarios WHERE Id_usuario = $id";
    

    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql_del_user);

    if (!$result){
        // Mostrame el siguiente error.
        die("Error en la consulta en la base de datos: " . $conn->connect_error);
    }
    header("Location: user_table.php");
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
