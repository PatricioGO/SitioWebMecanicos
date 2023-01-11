<?php include ("Templates/cabecera.php")?><!--Agregando templates-->

<!--Contenedor con formulario de contacto-->
<div class="container">
        <div class="row" >
            <div class="card">
                <div class="card-header">
                 <h3>Formulario de Contacto</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Ingrese sus Datos</h4>
                    <form >
                        <fieldset>                        
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label mt-4">Correo</label>
                                <input type="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" class="form-label mt-4">Descripción</label>
                                <textarea class="form-control"  id="exampleTextarea" rows="3" placeholder="Ingrese su mensaje"></textarea>
                            </div>
                            <fieldset class="form-group">
                                <legend class="mt-4">Razón de Contacto</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Cotización
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                                        Reclamo 
                                    </label>
                                </div>
                            </fieldset>
                            <br>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </fieldset>
                    </form>
                </div>
                
            </div>
                
             
        </div>
</div>












<?php include ("Templates/footer.php")?><!--Agregando templates-->