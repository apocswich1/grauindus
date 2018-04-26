<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>finanzas">Mantenedor Financiero &gt;&gt;</a></li>
      <li>Editar Mantenedor Financiero</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Datos</h3></div>
	
     <div class="control-group">
		<label class="control-label" for="usuario">Dólar</label>
		<div class="controls">
			<input type="text" id="link" name="dolar" value="<?php echo $datos->dolar?>" required="required" placeholder="Dólar" onkeypress="return soloNumeros(event)"  />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Fomento (UF)</label>
		<div class="controls">
			<input type="text" id="link" name="uf" value="<?php echo $datos->uf?>" placeholder="Unidad de Fomento (UF)" required="required" onkeypress="return soloNumeros(event)" />
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
        document.form.dolar.focus();
        }
    );
</script>
</div>
