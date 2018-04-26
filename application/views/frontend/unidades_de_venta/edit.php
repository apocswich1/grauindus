<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>unidades_de_venta">Unidad de Venta &gt;&gt;</a></li>
      <li>Editar Unidad de Venta</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Unidad de Venta</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Unidad de Venta</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->unidades_de_venta?>" placeholder="Unidad de Venta" />
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
