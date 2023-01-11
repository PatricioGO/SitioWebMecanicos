<?php include ("../Templates/cabecera.php")?><!--Agregando templates-->

<?php
    //condiciones ternarias 
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtTitulo=(isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
    $txtDescrip=(isset($_POST['txtDescrip']))?$_POST['txtDescrip']:"";
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../Config/conexion.php');//llamado a la conexion de BBDD

    //Estructura switch con logica de página e insercion de datos a BBDD
    switch ($accion) {

        case "agregar":
            $sentenciaSQL=$conexion->prepare("INSERT INTO trabajos (titulo, descripcion, imagen) VALUES (:titulo, :descripcion, :imagen);");
            $sentenciaSQL->bindParam(':titulo',$txtTitulo);
            $sentenciaSQL->bindParam(':descripcion',$txtDescrip);
            
            //insercion de imagen como archivo
            $fecha=new DateTime();
            $nombreArchivo = ($txtImagen!="") ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"] : "imagenVacia.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];      
            if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"../../IMG/".$nombreArchivo);                
            }
            
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->execute();
            
            break;
        
        case "modificar":
            $sentenciaSQL=$conexion->prepare("update trabajos set titulo = :titulo, descripcion = :descripcion where id = :id");
            $sentenciaSQL->bindParam(':titulo',$txtTitulo);
            $sentenciaSQL->bindParam(':descripcion',$txtDescrip);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            
            //modificar la imagen siempre y cuando el campo tenga un elemento
            if ($txtImagen!="") {
                $fecha=new DateTime();
                $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg" ;
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
                move_uploaded_file($tmpImagen,"../../IMG/".$nombreArchivo);

                $sentenciaSQL=$conexion->prepare("select imagen from trabajos where id = :id");
                $sentenciaSQL->bindParam(':id',$txtID);
                $sentenciaSQL->execute();
                $trabajos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                if (isset($trabajos["imagen"])&& ($trabajos["imagen"]!= "imagen.jpg")) {
                    if (file_exists("../../IMG/".$trabajos["imagen"])) {
                        unlink ("../../IMG/".$trabajos["imagen"]);
                    }
                }
                $sentenciaSQL=$conexion->prepare("update trabajos set imagen = :imagen where id = :id");
                $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
                $sentenciaSQL->bindParam(':id',$txtID);
                $sentenciaSQL->execute();
            }
            break;
        
        case "cancelar":
            header("location:trabajos.php");
            break;
        
        case "seleccionar":
            $sentenciaSQL=$conexion->prepare("select * from trabajos where id = :id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $trabajos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtTitulo=$trabajos['titulo'];
            $txtDescrip=$trabajos['descripcion'];
            $txtImagen=$trabajos['imagen'];
            break;
        
        case "borrar":
            $sentenciaSQL=$conexion->prepare("select imagen from trabajos where id = :id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $trabajos=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($trabajos["imagen"])&& ($trabajos["imagen"]!= "imagen.jpg")) {
                if (file_exists("../../IMG/".$trabajos["imagen"])) {
                    unlink ("../../IMG/".$trabajos["imagen"]);
                }
            }
            $sentenciaSQL=$conexion->prepare("delete from trabajos where id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            break;
    }

    // mostrar lista de trabajos desde la BBDD
    $sentenciaSQL=$conexion->prepare("select * from trabajos");
    $sentenciaSQL->execute();
    $listaTrabajos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<!--Formulario para registrar los trabajos en BBDD-->
<div class="col-md-6">
    <br>
    <div class="card">

        <div class="card-header">
            Administrador de Trabajos
        </div>

        <div class="card-body">
        
            <form method="POST" enctype="multipart/form-data">   
                <div class = "form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
                </div>
                <br>
                <div class = "form-group">
                    <label for="exampleInputEmail1">Título</label>
                    <input type="text" required class="form-control" value="<?php echo $txtTitulo;?>" name="txtTitulo" id="txtTitulo"  placeholder="Nombre del Título">
                </div>
                <br>
                <div class = "form-group">
                    <label for="exampleInputEmail1">Descripción</label>
                    <input type="text" required class="form-control" value="<?php echo $txtDescrip;?>" name="txtDescrip" id="txtDescrip"  placeholder="Ingrese la Descripción">
                </div>
                <br>
                <div class = "form-group">
                    <label for="exampleInputEmail1">Imagen</label>
                            <?php echo $txtImagen?>
                    <br>
                    <?php if($txtImagen!=""){?>
                        <img src="../../IMG/<?php echo $txtImagen?>" width="50" alt="">
                    <?php }?>
                    <input type="file" class="form-control"  name="txtImagen" id="txtImagen"  placeholder="">
                </div>
                <br>              
                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion"<?php echo($accion=="seleccionar")?"disabled":""?> value="agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

</div>


<!--Tabla que muestra los Trabajos registrados en BBDD-->
<div class="col-md-5">

    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaTrabajos as $trabajos){?>
                <tr>
                    <td><?php echo $trabajos['id'];?></td>
                    <td><?php echo $trabajos['titulo'];?></td>
                    <td><?php echo $trabajos['descripcion'];?></td>
                    <td>
                        
                        <img src="../../IMG/<?php echo $trabajos['imagen'];?>" width="50" >
                        <?php echo $trabajos['imagen'];?>
                    
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $trabajos['id'];?>">
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
