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
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Pedidos</title>
</head>
<body>
    <?php require('header.php')?>
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
            
        </div>
        
    </main>
    
</body>
</html>