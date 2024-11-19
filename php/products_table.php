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
    <title>Gestión de Productos</title>
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
        <div class="content-table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Articulo</th>
                    <th>Stock</th>
                    <th>Precio Venta</th>
                    
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
                <?php 
                $sql_prod = "SELECT * FROM Productos";
                $result = $conn->query($sql_prod);
                if (!$result){
                    // Mostrame el siguiente error.
                    die("Error en la consulta en la base de datos: " . $conn->error);
                }
                while($row = $result->fetch_assoc()) {?>  
                <tr>
                    <td><?php echo $row['Id_producto'];?></td>
                    <td><?php echo $row['Cod_Barras'];?></td>
                    <td><?php echo $row['Nombre'];?></td>
                    <td><?php echo $row['Stock'];?></td>
                    <td><?php echo $row['Precio_Venta'];?></td>
                   
                    <td><?php echo $row['Categoria'];?></td>
                    <td>
                        <button class="btn-modi"><a href="products_modify.php?id=<?php echo $row['Id_producto']?>">Modificar</a></button>
                        <button class="btn-del"><a href="products_delete.php?id=<?php echo $row['Id_producto']?>">Eliminar</a></button>
                    </td>
                </tr>
                <?php }?>
            </table>    
        </div>
    </main>
    
</body>
</html>