<?php
// Inicia el buffer
ob_start(); 

// Incluyo la conexion a la base de datos.
include ('connection.php');

// Verifico si los datos del formulario se enviaron correctamente por el metodo POST.
if (isset($_POST['load'])) {
    //Obtengo los datos del formulario y los guardo en variables.
    $name = $_POST['user'];
    $passwd = $_POST['password'];
    $type = $_POST['select'];

    // Insertar datos en la tabla Usuarios
    $sql = "INSERT INTO Usuarios (Nombre, Clave, Tipo)
    VALUES ('$name', '$passwd', '$type')";

    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql);

    if ($result === true) {
        echo "Usuario agregado correctamente";
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
