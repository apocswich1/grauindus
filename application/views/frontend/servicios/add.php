<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>servicios">Servicios Internos y Externos &gt;&gt;</a></li>
      <li>Agregar Servicios Internos y Externos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Servicios Internos y Externos</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="Interno">Interno</option>
                <option value="Externo">Externo</option>
                
            </select>
		</div>
	</div>
    
    
     <div class="control-group">
		<label class="control-label" for="usuario">Servicio</label>
		<div class="controls">
			<input type="text" id="link" name="servicio" value="<?php echo set_value("servicio")?>" placeholder="Servicio" required="required" />
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
