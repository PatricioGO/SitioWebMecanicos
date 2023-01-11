<?php include ("Templates/cabecera.php")?><!--Agregando templates-->

<br><br><br>
<h1 class="text-center">Trabajos Realizados</h1>
<br><br><br>

<!--Cards con trabajos realizados en pagina index-->
<div class="row">
    <div class="col-md-6">
        <a class="nav-item nav-link" href="<?php echo $url;?>/trbelectro.php"> 
            <div class="card">
                <img class="card-img-top" src="IMG/Electr_Autom.jpeg" alt="EspecialistaElectrico" width="80px">
                    <div class="card-body">
                        <h4 class="card-title">Electrónica automotriz</h4>
                    </div>
            </div>
        </a>   
    </div>

    <div class="col-md-6">
        <a class="nav-item nav-link" href="<?php echo $url;?>/trbcajas.php">
            <div class="card">
                <img class="card-img-top" src="IMG/CCambios.jpeg" alt="Especialista en cajas">
                    <div class="card-body">
                        <h4 class="card-title">Reparación cajas de cambio</h4>
                    </div>
            </div>
        </a>
    </div>

</div>
          
<?php include ("Templates/footer.php")?><!--Agregando templates-->
       