<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>procesos_especiales/index/<?php echo $pagina?>">Procesos Especiales &gt;&gt;</a></li>
      <li>Adicionar Procesos Especiales</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Adicionar Procesos Especiales</h3></div>
 
     
     <div class="control-group">
		<label class="control-label" for="usuario">Tipo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="tipo">
                <option value="1" <?php if($datos->tipo=='1'){echo 'selected="true"';}?>>Oro</option>
                <option value="2" <?php if($datos->tipo=='2'){echo 'selected="true"';}?>>Plata</option>
                <option value="3" <?php if($datos->tipo=='3'){echo 'selected="true"';}?>>Cobre</option>                
            </select>
		</div>
	</div>
     
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		<select name="id_proveedores" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $proveedor)
                {
                    ?>
                    <option value="<?php echo $proveedor->id?>" <?php if($datos->id_proveedores==$proveedor->id){echo 'selected="selected"';}?>><?php echo $proveedor->nombre; ?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>  

    
	 
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="nombre_procesp" name="nombre_procesp" value="<?php echo $datos->nombre_procesp; ?>" placeholder="Nombre" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="ancho" name="ancho" value="<?php echo $datos->ancho?>" placeholder="Número"/>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Largo <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="largo" name="largo" value="<?php echo $datos->largo?>" placeholder="Número"/>
		</div>
	</div>    


    <div class="control-group">
		<label class="control-label" for="usuario">Precio <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="precio" name="precio" value="<?php echo $datos->precio?>" placeholder="Número"/>
		</div>
	</div>       
    
	<div class="control-group">
		<div class="form-actions"> 
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="archivo" value="<?php echo $datos->archivo?>" />
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
</form>
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
            document.form.nom.focus();
        }
    );
    
</script>
</div>
