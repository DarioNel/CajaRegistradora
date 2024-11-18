<?php
ob_start(); 
include('connection.php'); 
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
            //echo "Producto no encontrado.";
        }
    }
}
// Calculo el total y guardo en una variable sesion para pasar al archivo sales_insert.php

$total = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $importe = $producto['precio'] * $producto['cantidad'];
        $total += $importe;
    }
}
$_SESSION['total']= $total;
$conn->close();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/popup.css">
    <title>Registradora</title>
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
        <div class="content-total">
            <p class="parrafo">Total</p> 
            <div class="total price">
                 <span class="total-valor"><?php echo "$" .  number_format($total, 2);?></span>
            </div>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Importe</th>
                    <th>Acción</th>
                </tr>
                <tr>
                <?php
                if (!empty($_SESSION['carrito'])) {
                    //$total = 0;
                    foreach ($_SESSION['carrito'] as $producto) {
                        $importe = $producto['precio'] * $producto['cantidad'];
                        //$total += $importe;
                        echo "<tr>
                                <td>{$producto['id_producto']}</td>
                                <td>{$producto['codigo']}</td>
                                <td>{$producto['nombre']}</td>
                                <td>{$producto['cantidad']}</td>
                                <td>{$producto['precio']}</td>
                                <td>$importe</td>
                                <td>
                                    <a href='main_admin.php?eliminar_producto={$producto['codigo']}'>Eliminar</a>
                                </td>
                              </tr>";
                    }
                    
                } else {
                    echo "<tr><td colspan='7'>No hay productos en la caja</td></tr>";
                }
                ?>  
                </tr>
            </table>
        </div>
        <div class="content-vuelto">
            <p class="parrafo">Vuelto</p>
            <div class="vuelto">
                <?php 
                // Verifico si el valor 'import' esta definido y es numerico
                if (isset($_POST['import']) && is_numeric($_POST['import'])) {
                    $import = (float) $_POST['import']; // Convertimos a float
                } else {
                    $import = 0; 
                }

                $vuelto = $import - $total;
                ?>
                <span class="vuelto-valor"><?php echo "$" . number_format($vuelto, 2);?></span>
                
            </div>
            <div class="input-barras">
                <form action="main_admin.php" method="POST">
                    <input type="text" name="valor" placeholder="Código de barras" onkeydown="if(event.key === 'Enter'){this.form.submit();}" required/>
                    <input class="cant" type="number" name="cant" value="1" min="1" onkeydown="if(event.key === 'Enter'){this.form.submit();}" required/>
                    <input class="import" type="number" name="import" placeholder="Importe" onkeydown="if(event.key === 'Enter'){this.form.submit();}" required/>
                </form>
            </div>
            <div class="btns">
                <button class="btn-blue" type="submit" name="Continuar" id="btn-abrir-popup">Continuar</button>
                <!-- Botón para vaciar el carrito -->
                <form action="main_admin.php" method="POST">
                    <button class="btn-red" type="submit" name="vaciar_carrito">Limpiar</button>
                </form>
            </div>
        </div>
    </main>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <h3 class="h3">Confirmar la venta</h3>
            <form action="sales_insert.php" method='POST'>
                <div class="inputs-content">
                    <input type="text" name="cli" placeholder="Nombre Cliente"/>
                    <input type="number" name="dni" placeholder="DNI"/>
                    <input type="date" name="fecha" placeholder="Fecha"/>
                    <select class="tipo" name="pago" id="select">
                        <option disabled selected >Tipo de Pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Otros Medios">Otros medio de pago</option>	
                    </select>                                                                        
                </div>
                <div class="btnss">
                    <button class="btn-submit "type="submit" name="venta">Confirmar</button>
                    <a href="#" id="btn-cerrar-popup" class="btn-close">Cancelar</a>     
                </div>
            </form>
        </div>
    </div> 
    <script src="../js/script.js"></script>    
</body>
</html>