<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>formas_pago/index">Formas de Pago &gt;&gt;</a></li>
      <li>Editar Forma de Pago</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Forma de Pago</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Forma de Pago</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->forma_pago?>" placeholder="Forma de Pago" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Días</label>
		<div class="controls">
			<input type="text" id="titulo" name="dias" value="<?php echo $datos->dias?>" placeholder="Forma de Pago" onkeypress="return soloNumeros(event)"  />
		</div>
	</div>
    
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
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
