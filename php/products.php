<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Productos</title>
</head>
<body>
    <?php require('header.php')?>
    <main>
        <?php
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
            $user = $_SESSION['nombre'];
            $type = $_SESSION['tipo'];
            echo "Bienvenido: $user<br>";
        } else {
            // Si no hay una sesión iniciada, entonces...
            header("Location: hello.php");
            exit();
        }
        ?>         
        <div class="content-prod">
            <form class="form-prod" action="" method="POST">
                <div class="caja1">
                    <label class="label" for="code">Codigo de Barras</label>
                    <input class="input" type="text" name="code" id="code" placeholder="Escriba el Código" maxlength="15" required/>      
                    <label class="label" for="products">Nombre del Producto</label>
                    <input class="input" type="text" name="products" id="products" placeholder="Ingrese Articulo" maxlength="15" required/>
                    <label class="label" for="stock">Stock</label>
                    <input class="input" type="text" name="stock" id="stock" placeholder="Ingrese la Cantidad" maxlength="15" required/>
                </div>
                <div class="caja2">
                    <label class="label" for="price">Precio de Venta</label>
                    <input class="input" type="text" name="price" id="price" placeholder="Ingrese un Precio" maxlength="15" required/>
                    <label class="label" for="price">Precio de Costo</label>
                    <input class="input" type="text" name="price2" id="price2" placeholder="Ingrese un Precio" maxlength="15" required/>
                    <label class="label" for="select">Categoría</label><br><br>    
                    <select class="" name="select" id="select">
                        <option value="select" disabled selected >Elija una Categoría</option>
                        <option value="">Articulo de Limpieza</option>
                        <option value="">Comestibles</option>
                        <option value="">Bebidas</option>
                        <option value="">Golosinas</option>
                        <option value="">Otros</option>	
                    </select>             
                </div>
                
                <div class="btns">
                    <button class="btn-blue" type="submit" name="Confirmar">Cargar </button>
                    <a href="products_table.php" class="btn-red">Mostrar</a>
                </div>

            </form> 
        </div>
        
    </main>
    
</body>
</html>