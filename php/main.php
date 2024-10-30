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
    <?php require('header.php')?>
    <main>
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