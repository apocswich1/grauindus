<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>unidades_de_uso/index">Unidad de Uso &gt;&gt;</a></li>
      <li>Agregar Unidad de Uso</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Unidad de Uso</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Unidad de Compra</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Unidad de Compra" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Unidad de Venta</label>
		<div class="controls">
			<input type="text" id="unidad_venta" name="unidad_venta" value="<?php echo set_value("unidad_venta")?>" placeholder="Unidad de Venta" />
		</div>
	</div>
        
	<div class="control-group">
		<label class="control-label" for="usuario">Factor de Conversión</label>
		<div class="controls">
			<input type="text" id="factor_conv" name="factor_conv" value="<?php echo set_value("factor_conv")?>" placeholder="Factor de Conversión" />
		</div>
	</div>   
        
        
	<div class="control-group">
		<label class="control-label" for="usuario">Unidad de Uso</label>
		<div class="controls">
			<input type="text" id="unidad_uso" name="unidad_uso" value="<?php echo set_value("unidad_uso")?>" placeholder="Unidad de Uso" />
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
