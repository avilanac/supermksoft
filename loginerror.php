<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body background="img/fondo111.jpg"  >
    <div id="main" >
        <div class="container" id="formLogin">
            <div>
                <img src="img/Supermercado XYZ.png" width="250" height="250" alt=""/>
            </div>
            <h3>Iniciar Sesión</h3><br>
            <form method ="post" name = "formreg" autocomplete = "off" action ="includes/inicio.php">
                <div class="form-group">
                    <input type="varchar" class="form-control" id="idusu" placeholder="Documento o Usuario" name="id">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" placeholder="Clave" name="pass">
                </div>
                 
                <br>
                <input type="submit" class="btn btn-success" name="ingreso" value="Ingresar">
                <a href="index.html">
                    <input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver">
                </a>
            </form>
        </div>
    </div>
</body>
</html>