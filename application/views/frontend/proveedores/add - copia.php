<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>proveedores/index">Proveedores &gt;&gt;</a></li>
      <li>Agregar Proveedor</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Proveedor</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Proveedor" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="titulo" name="tel" value="<?php echo set_value("tel")?>" placeholder="Teléfono" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
		<div class="controls">
			<input type="text" id="titulo" name="correo" value="<?php echo set_value("correo")?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Rubro</label>
		<div class="controls">
			<input type="text" id="titulo" name="rubro" value="<?php echo set_value("rubro")?>" placeholder="Rubro" />
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
        document.form.nom.focus();
        }
    );
    
</script>
</div>
