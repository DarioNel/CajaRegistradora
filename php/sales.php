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
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Ventas</title>
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
            <table class="table-sales">
                <tr>
                    <th>Fecha</th>
                    <th>DNI</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>Tipo de Pago</th>
                    <th>Vendedor</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
                <?php 
                $sql_ventas = "SELECT 
                                v.Fecha, 
                                c.DNI, 
                                c.Nombre AS Cliente, 
                                v.Total AS Monto, 
                                v.Tipo_pago, 
                                u.Nombre AS Vendedor, 
                                p.Nombre AS Producto, 
                                dv.Cantidad, 
                                dv.Importe
                                FROM Ventas v
                                JOIN Clientes c ON v.Id_cliente = c.Id_cliente
                                JOIN Usuarios u ON v.Id_usuario = u.Id_usuario
                                JOIN Detalles_Ventas dv ON v.Id_venta = dv.Id_venta
                                JOIN Productos p ON dv.Id_producto = p.Id_producto
                                ORDER BY v.Fecha DESC, c.Nombre, p.Nombre";
                                                                            
                $result = $conn->query($sql_ventas);
                if (!$result){
                    // Mostrame el siguiente error.
                    die("Error en la consulta en la base de datos: " . $conn->error);
                }
                // Mostrar los resultados
                while($row = $result->fetch_assoc()) { ?>  
                <tr>
                    <td><?php echo $row['Fecha']; ?></td> <!-- Fecha de la venta -->
                    <td><?php echo $row['DNI']; ?></td> <!-- DNI del cliente -->
                    <td><?php echo $row['Cliente']; ?></td> <!-- Nombre del cliente -->
                    <td><?php echo number_format($row['Monto'], 2, ',', '.'); ?></td> <!-- Monto total de la venta -->
                    <td><?php echo $row['Tipo_pago']; ?></td> <!-- Tipo de pago-->
                    <td><?php echo $row['Vendedor']; ?></td> <!-- Nombre del vendedor -->
                    <td><?php echo $row['Producto']; ?></td> <!-- Nombre del producto -->
                    <td><?php echo $row['Cantidad']; ?></td> <!-- Cantidad de producto vendido -->
                    <td><?php echo number_format($row['Importe'], 2, ',', '.'); ?></td> <!-- Importe por producto -->
                </tr>
                <?php } ?>   
            </table>
        </div>   
    </main>
</body>
</html>