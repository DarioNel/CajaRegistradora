<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    <div class="header-titulo">Caja Registradora - Despensa Don CoCo</div>
    <div class="titulo">
        <h3>Punto de Ventas</h3>
        <img src="../img/express.png" alt="" class="express"/>
    </div>
    
    <div class="login">
        <img src="../img/user.png" alt="" class="logo-login"/>
        <p class="loginError" >Usuario o contraseña incorrecta</p>
        <form class="form" action="authenticate.php" method="POST">
            
            <input class="input" type="text" name="user" placeholder="Usuario" maxlength="15" required/>
            <input class="input" type="password" name="passwd" placeholder="Contraseña" maxlength="15" required/>
            
            <button class="send" type="submit" name="send">Iniciar Sesión</button>
        </form>    
    </div>

</body>
</html>