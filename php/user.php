<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Usuarios</title>
</head>
<body>
    <?php require('header.php')?>
    <main>
        <div class="content-user">
            <form class="form-user" action="" method="">
                <label for="user">Usuario</label>
                <input class="input" type="text" name="name" id="user" placeholder="Escriba un Usuario" maxlength="15" required/><br>
                <label for="passwd">Contraseña</label>
                <input class="input" type="password" name="password" id="passwd" placeholder="Escriba una Contraseña" maxlength="15" required/><br>
                <label for="select">Tipo</label>
                <select class="input" name="select" id="select">
                    <option value="select" disabled selected >Elija tipo de Usuario</option>
                    <option value="admin">Administrador</option>
                    <option value="employee">Empleado</option>	
                </select>
                <div class="btns">
                    <button class="btn-blue" type="submit" name="Confirmar">Confirmar</button>
                    <button class="btn-red"  type="submit" name="Modificar">Modificar</button>
                </div>    
            </form> 
        </div>
        
    </main>
    
</body>
</html>