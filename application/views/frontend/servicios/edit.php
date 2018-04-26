<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>servicios">Servicios Internos y Externos &gt;&gt;</a></li>
      <li>Editar Servicios Internos y Externos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Servicios Internos y Externos</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="Interno" <?php if($datos->tipo=="Interno"){echo 'selected="selected"';}?>>Interno</option>
                <option value="Externo" <?php if($datos->tipo=="Externo"){echo 'selected="selected"';}?>>Externo</option>
                
            </select>
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Servicio</label>
		<div class="controls">
			<input type="text" id="link" name="servicio" value="<?php echo $datos->servicio?>" required="required" placeholder="Servicio" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="link" name="precio" value="<?php echo set_value("precio")?>" placeholder="Precio" required="required" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
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
        document.form.servicio.focus();
        }
    );
</script>
</div>
