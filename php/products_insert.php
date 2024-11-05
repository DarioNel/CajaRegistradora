<?php
// Inicia el buffer
ob_start(); 

// Incluyo la conexion a la base de datos.
include ('connection.php');

// Verifico si los datos del formulario se enviaron correctamente por el metodo POST.
if (isset($_POST['loadpro'])) {
    //Obtengo los datos del formulario y los guardo en variables.
    $code = $_POST['code'];
    $prod = $_POST['products'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $price2 = $_POST['price2'];
    $type = $_POST['category'];

    // Insertar datos en la tabla Productos
    $sql = "INSERT INTO Productos (Cod_Barras, Nombre, Stock, Precio_Venta, Precio_Costo, Categoria)
    VALUES ('$code', '$prod', '$stock', '$price','$price2','$type')";
    echo $sql;

    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql);

    if ($result === true) {
        echo "Producto agregado correctamente";
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
