<!--Definicion de la pagina Login--> 
<?php
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

  switch ($accion) {
    case "entrar":
      header('location:index.php');
      break;
    case "volver";
      header("location: http://".$_SERVER['HTTP_HOST']."/MecanicosWeb");
      break;
  }
?>
<!--Definicion de la pagina Login--> 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/bootstrap.css" />
  <title>LogIn</title>
</head>
<body>
<br><br>

<?php $url="http://".$_SERVER['HTTP_HOST']."/MecanicosWeb"?><!--Variable con url de redirección--> 


<!--Etiqueta con aviso de no-LogIn--> 
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <span class="badge bg-danger">Usuario No Logueado</span>
    </div>
  </div>
</div>

<br><br>
  <!--Definición del formulario de Login  --> 
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
              Ingresar a la página de Administración
          </div>
              <div class="card-body">
                <form method="POST">
                  <div class = "form-group">
                    <label for="exampleInputEmail1">Correo del Usuario</label>
                    <input type="text"  class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Ingresar Correo de Usuario">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password"  class="form-control" name="contrasena" placeholder="Ingrese Contraseña">
                  </div>
                  <br>
                  <button type="submit" name="accion" value="entrar" class="btn btn-primary">Ingresar</button>
                  <button type="submit" name="accion" value="volver" class="btn btn-light"> <- Volver Al Sitio Principal</button>

                </form>
              </div>    
        </div>
      </div>

      <!--Definición del formulario de registrar--> 
      <div class="col-6">
        <div class="card">
          <div class="card-header">
              Registrarse como Administrador
          </div>
              <div class="card-body">
                <form method="POST">
                  <div class = "form-group">
                    <label for="exampleInputEmail1">Correo del Usuario</label>
                    <input type="text" required class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Ingresar Correo de Usuario">
                  </div>
                  <br>
                  <div class = "form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Ingresar Nombre ">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" required class="form-control" name="contrasena" placeholder="Ingrese Contraseña">
                  </div>
                  <br>
                  <button type="submit" name="accion" value="entrar" name="entrar" class="btn btn-primary">Registrar</button>
                </form>
              </div>    
        </div>
      </div> 
    </div>

  </div>
</body>
</html>





