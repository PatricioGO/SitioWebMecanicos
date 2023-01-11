<?php include ("../Templates/cabecera.php")?><!--Agregando templates-->

<?php
//condiciones ternarias 
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtRut=(isset($_POST['txtRut']))?$_POST['txtRut']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
    $txtEdad=(isset($_POST['txtEdad']))?$_POST['txtEdad']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtNumero=(isset($_POST['txtNumero']))?$_POST['txtNumero']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../Config/conexion.php');//llamado a la conexion de BBDD
    
    //Estructura switch con logica de página e insercion de datos a BBDD
    switch ($accion) {
        case "agregar":
            $sentenciaSQL=$conexion->prepare("INSERT INTO mecanicos (rut, nombre, apellido, edad, correo, numero) VALUES (:rut, :nombre, :apellido, :edad, :correo, :numero);");
            $sentenciaSQL->bindParam(':rut',$txtRut);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':edad',$txtEdad);
            $sentenciaSQL->bindParam(':correo',$txtCorreo);
            $sentenciaSQL->bindParam(':numero',$txtNumero);
            $sentenciaSQL->execute();
            break;
        case "modificar":
            $sentenciaSQL=$conexion->prepare("update mecanicos set rut = :rut, nombre = :nombre, apellido = :apellido, edad = :edad,correo = :correo, numero = :numero  where id = :id");
            $sentenciaSQL->bindParam(':rut',$txtRut);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':edad',$txtEdad);
            $sentenciaSQL->bindParam(':correo',$txtCorreo);
            $sentenciaSQL->bindParam(':numero',$txtNumero);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            break;
        case "cancelar":
            header("location:mecanicos.php");
            
            break;  
            
        case "seleccionar":
            $sentenciaSQL=$conexion->prepare("select * from mecanicos where id = :id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $mecanicos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtRut=$mecanicos['rut'];
            $txtNombre=$mecanicos['nombre'];
            $txtApellido=$mecanicos['apellido'];
            $txtEdad=$mecanicos['edad'];
            $txtCorreo=$mecanicos['correo'];
            $txtNumero=$mecanicos['numero'];
            break;
    
        case "borrar":
            $sentenciaSQL=$conexion->prepare("delete from mecanicos where id = :id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            break;
    }
    // mostrar lista de mecanicos
    $sentenciaSQL=$conexion->prepare("select * from mecanicos");
    $sentenciaSQL->execute();
    $listaMecanicos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="col-md-6">
<br><br>
    <div class="card">

        <div class="card-header">
            Administrador de Mecanicos
        </div>

        <div class="card-body">
            
            <!--Formulario de administración de mecanicos-->
            <form method="POST" > 
                <div class = "form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Rut</label>
                    <input type="text" required class="form-control" value="<?php echo $txtRut;?>" name="txtRut" id="txtRut"  placeholder="Ingrese su rut (sin puntos ni guiones)">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Ingrese su Nombre">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Apellido</label>
                    <input type="text" required class="form-control" value="<?php echo $txtApellido;?>" name="txtApellido" id="txtApellido"  placeholder="Ingrese su Apellido">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Edad</label>
                    <input type="text" required class="form-control" value="<?php echo $txtEdad;?>" name="txtEdad" id="txtEdad"  placeholder="Ingrese su Edad">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Correo</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo"  placeholder="Ingrese su Correo">
                </div>

                <div class = "form-group">
                    <label for="exampleInputEmail1">Número</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNumero;?>" name="txtNumero" id="txtNumero"  placeholder="Ingrese su Número(9 999 99 99)">
                </div>
                <br>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion"<?php echo($accion=="seleccionar")?"disable":""?> value="agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

</div>


<!--  Tabla de mecanicos de la BBDD --> 
<div class="col-md-5">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">RUT</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Edad</th>
      <th scope="col">Correo</th>
      <th scope="col">Número</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach ($listaMecanicos as $mecanicos){?>
            <tr>
                <td><?php echo $mecanicos['id'];?></td>
                <td><?php echo $mecanicos['rut'];?></td>
                <td><?php echo $mecanicos['nombre'];?></td>
                <td><?php echo $mecanicos['apellido'];?></td>
                <td><?php echo $mecanicos['edad'];?></td>
                <td><?php echo $mecanicos['correo'];?></td>
                <td><?php echo $mecanicos['numero'];?></td>
                <td><?php echo $mecanicos['accion'];?></td>

                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $mecanicos['id'];?>">
                        <input type="submit" name = "accion" value="seleccionar" class="btn btn-primary">
                        <input type="submit" name = "accion" value="borrar" class="btn btn-danger">
                    </form>                    
                </td>
            </tr>
        <?php }?>

  </tbody>
</table>

    
</div>



<?php include ("../Templates/footer.php")?><!--Agregando templates-->
