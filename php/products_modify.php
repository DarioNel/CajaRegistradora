<?php
// Inicia el buffer
ob_start(); 

// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluyo la conexion a la base de datos.
include ('connection.php');

// Si la id que recivo no esta vacia.
if (isset($_GET['id'])){
    $id = trim($_GET['id']); // La almaceno en una variable.
  
    // Realiza la consulta sql, para modificar los datos de la tabla Productos.
    $sql_prod = "SELECT * FROM Productos
    WHERE Id_producto = $id";
    
    // Si la conexion, y la consulta es correcta, los almaceno en una variable llamada result.         
    $result = $conn->query($sql_prod);

    if (!$result){
        // Mostrame el siguiente error.
        die("Error en la consulta en la base de datos: " . $conn->error);
    }
    
    if ($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $code = $row['Cod_Barras']; 
        $pro = $row['Nombre']; 
        $stock = $row['Stock'];
        $price = $row['Precio_Venta']; 
        
        $type = $row['Categoria'];
    }

    if (isset($_POST['modify'])){
        $id = trim($_GET['id']);
        $code = trim($_POST['code']);
        $pro= trim($_POST['products']);
        $stock = trim($_POST['stock']);
        $price = trim($_POST['price']);
        
        $type = trim($_POST['category']);
        
        // Realiza la consulta sql, para modificar los datos de la tabla usuarios
        $sql_update_prod = "UPDATE Productos 
                            SET Cod_Barras = '$code', Nombre = '$pro', Stock = '$stock',
                            Precio_Venta = '$price', Categoria = '$type'
                            WHERE Id_producto = $id";
        //
        $result2 = $conn->query($sql_update_prod);

        header("Location: products_table.php");

        if (!$result2){
            // Mostrame el siguiente error.
            die("Error en la consulta en la base de datos: " . $conn->error);
        }
    }    
}
// Cerrar la conexión a la base de datos
$conn->close();
ob_end_flush(); // Envía el contenido al navegador
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Modificar Productos</title>
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
        <div class="content-prod">
            <form class="form-prod" action="products_modify.php?id=<?php echo $_GET['id'];?>" method="POST">
                <div class="caja1">
                    <label class="label" for="code">Codigo de Barras</label>
                    <input class="input" type="text" name="code" id="code" value="<?php echo $code?>" placeholder="Escriba el Código" maxlength="30" required/>      
                    <label class="label" for="products">Nombre del Producto</label>
                    <input class="input" type="text" name="products" id="products" value="<?php echo $pro?>" placeholder="Ingrese Articulo" maxlength="50" required/>
                    <label class="label" for="stock">Stock</label>
                    <input class="input" type="text" name="stock" id="stock" value="<?php echo $stock?>" placeholder="Ingrese la Cantidad" maxlength="15" required/>
                </div>
                <div class="caja2">
                    <label class="label" for="price">Precio de Venta</label>
                    <input class="input" type="text" name="price" id="price" value="<?php echo $price?>" placeholder="Ingrese un Precio" maxlength="15" required/>
                
                    <label class="label" for="select">Categoría</label><br><br>    
                    <select class="" name="category" id="select" value="<?php echo $type?>">
                        <option value="select" disabled selected >Elija una Categoría</option>
                        <option value="Limpieza">Articulo de Limpieza</option>
                        <option value="Comestibles">Comestibles</option>
                        <option value="Bebidas">Bebidas</option>
                        <option value="Golosinas">Golosinas</option>
                        <option value="Otros">Otros</option>	
                    </select>             
                </div>
                
                <div class="btns">
                    <button class="btn-blue"  type="submit" name="modify">Actualizar</button>
                </div>

            </form> 
        </div>    
    </main>
    
</body>
</html>