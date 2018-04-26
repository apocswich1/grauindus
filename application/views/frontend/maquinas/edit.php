<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>maquinas/index/<?php echo $pagina?>">Máquinas &gt;&gt;</a></li>
      <li>Editar Máquina</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Máquina</h3></div>
	
   <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" />
		</div>
	</div>
	 
      <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<textarea id="contenido4" name="des" placeholder="Descripción"><?php echo $datos->descripcion?></textarea>
		</div>
	</div>
     
   <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño Máximo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="tamano_maximo" style="width: 100px;" value="<?php echo $datos->tamano_maximo?>" placeholder="Máximo (milímetros)" /> X <input type="text" name="tamano_minimo" style="width: 100px;" value="<?php echo $datos->tamano_minimo?>" placeholder="Mínimo (milímetros)" /> 
		</div>
	</div>
     
	 <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores">
                <?php
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($datos->colores==$i){echo 'selected="true"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Velocidad</label>
		<div class="controls">
			<input type="text" id="titulo" name="velocidad" value="<?php echo $datos->velocidad?>" placeholder="Velocidad" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tiempo de Postura <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="tiempo_de_postura" value="<?php echo $datos->tiempo_de_postura?>" placeholder="Tiempo de Postura" />
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Tamaño Mínimo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="ancho_maximo" style="width: 100px;" value="<?php echo $datos->ancho_maximo?>" placeholder="Máximo (milímetros)" /> X <input type="text" name="ancho_minimo" style="width: 100px;" value="<?php echo $datos->ancho_minimo?>" placeholder="Mínimo (milímetros)" /> 
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Procesos</label>
		<div class="controls">
			 <?php
                $i=0;
                foreach($procesos as $proceso)
                {
                    $existe=$this->maquinas_model->existeProcesoEnMaquina($proceso->id,$id);
                    ?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="<?php echo $proceso->id?>" name="<?php echo "name_".$i?>" <?php if(sizeof($existe)>=1){echo 'checked="true"';}?> />
                        <?php echo $proceso->nombre?> 
                      </label>
                    </div>
                    <?php
                $i++;
                }
                ?>
		</div>
	</div>
   
     
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
</form>

<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.cliente.focus();
        }
    );
    
</script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  <script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
	

    
</script>
</div>
