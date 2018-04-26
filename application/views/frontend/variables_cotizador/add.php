<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>variables_cotizador">Variables Cotizador &gt;&gt;</a></li>
      <li>Agregar Variables Cotizador</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Variables Cotizador</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="Pre-Impresión">Pre-Impresión</option>
                <option value="Producción">Producción</option>
                <option value="Costos Varios">Costos Varios</option>
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" required="required" />
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="link" name="precio" value="<?php echo set_value("precio")?>" placeholder="Precio" required="required" />
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
