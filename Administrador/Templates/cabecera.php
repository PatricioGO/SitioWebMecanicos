<!--Variable con url de redirección--> 
<?php $url="http://".$_SERVER['HTTP_HOST']."/MecanicosWeb"?>


<!--Definicion de la cabecera del sitio Admin--> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $url;?>/Administrador/index.php">Administrador</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/Administrador/Seccion/mecanicos.php">Mecanicos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/Administrador/Seccion/trabajos.php">Administrador de Trabajos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $url;?>/Administrador/login.php">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="container">
        <div class="row">
            <br><br><br>