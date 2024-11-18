<?php
ob_start(); 
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $dni= $_POST['dni'];
    $cliente= $_POST['cli'];
    $fecha = $_POST['fecha'];
    $pago = $_POST['pago'];

    $sql1 = "INSERT INTO Clientes (DNI, Nombre)
    VALUES ('$dni','$cliente')";

    if ($conn->query($sql1) === TRUE) {
    // Obtengo el Id de clientes
    $id_cliente = $conn->insert_id;
    echo "El cliente se inserto correctamente";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }        
 
    $id_usuario = $_SESSION['id_user'];
    $totalcompras = $_SESSION['total'];

    $sql2 = "INSERT INTO Ventas (Fecha, Total, Tipo_pago, Id_usuario, Id_cliente)
    VALUES ('$fecha','$totalcompras','$pago','$id_usuario','$id_cliente' )";

    if ($conn->query($sql2) === TRUE) {
        // Obtengo el Id de ventas
        $id_ventas = $conn->insert_id;
        echo "Los datos de la tabla Ventas se insertaron correctamente";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    
    foreach ($_SESSION['carrito'] as $producto){

        $importe = $producto['precio'] * $producto['cantidad'];
        $sql3 = "INSERT INTO Detalles_Ventas (Id_venta, Id_producto, Cantidad, Importe)
                 VALUES ('$id_ventas', '{$producto['id_producto']}', '{$producto['cantidad']}', '$importe')";

                 if ($conn->query($sql3) === FALSE) {
                    echo "Error al insertar los datos en la tabla detalle ventas" . $conn->error;
                } else {
                    echo "Los datos de la tabla DetallesVentas se insertaron correctamente";
                    header("Location: main_admin.php");
                }
    }    
} 
$conn->close();
ob_end_flush();           
?> 