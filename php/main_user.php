<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();    
}
// Inicia la sesión para el carrito si no está ya iniciada
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}
// Función para vaciar el carrito
if (isset($_POST['vaciar_carrito'])) {
    $_SESSION['carrito'] = array(); // Vaciar el carrito
}

// Función para eliminar un producto del carrito
if (isset($_GET['eliminar_producto'])) {
    $codigo_producto = $_GET['eliminar_producto']; // Obtener el código del producto a eliminar
    unset($_SESSION['carrito'][$codigo_producto]); // Eliminar el producto del carrito
}

// Valido que el dato del formulario se haya enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['vaciar_carrito'])) {
    $cod_barras = trim($_POST['valor']); // Código de barras escaneado
    $cantidad = isset($_POST['cant']) ? $_POST['cant'] : 1; // Cantidad ingresada, por defecto 1

    // Realizo la consulta a la base de datos
    $sql_cod = "SELECT Id_producto, Cod_Barras, Nombre, Precio_Venta 
                FROM Productos
                WHERE Cod_Barras = '$cod_barras'";

    $result = $conn->query($sql_cod);
    if ($result === false) {
        echo "ERROR: No pudo leer los datos solicitados" . $conn->error;
    } else {
        // Si la consulta devuelve un producto
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Asignamos los valores de la fila a las variables
            $idp = $row['Id_producto'];
            $cod = $row['Cod_Barras'];
            $art = $row['Nombre'];
            $pre = $row['Precio_Venta'];

            // Si el producto ya está en el carrito, actualiza la cantidad
            if (isset($_SESSION['carrito'][$cod])) {
                $_SESSION['carrito'][$cod]['cantidad'] += $cantidad; // Aumenta la cantidad
            } else {
                // Si el producto no está en el carrito, lo agrega
                $_SESSION['carrito'][$cod] = array(
                    'id_producto' => $idp,
                    'codigo' => $cod,
                    'nombre' => $art,
                    'precio' => $pre,
                    'cantidad' => $cantidad
                );
            }
        } else {
            echo "Producto no encontrado.";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Registradora</title>
</head>
<body>
    <?php require('header_user.php');?>
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
        <div class="content-total">
            <p class="parrafo">Total</p> 
            <div class="total">
             $ 0,00
            </div>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Articulo</th>
                    <th>Precio</th>
                    <th>Importe</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="content-vuelto">
            <p class="parrafo">Vuelto</p>
            <div class="vuelto">
                $ 0,00
            </div>
            <div class="btns">
                <button class="btn-blue" type="submit" name="Continuar">Continuar</button>
                <button class="btn-red"  type="submit" name="Limpiar">Limpiar</button>
            </div>
        </div>
    </main>
    
</body>
</html>