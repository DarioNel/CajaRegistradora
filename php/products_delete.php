<?php
// Inicia el buffer
ob_start();  

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluyo la conexion a la base de datos.
include ('connection.php');

if (isset($_GET['id'])){
    $id = trim($_GET['id']);
  
    // Realiza la consulta sql, para eliminar los datos de la tabla productos
    $sql_del_pro = "DELETE FROM Productos WHERE Id_producto = $id";
    

    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql_del_pro);

    if (!$result){
        // Mostrame el siguiente error.
        die("Error en la consulta en la base de datos: " . $conn->error );
    }
    header("Location: products_table.php");
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
