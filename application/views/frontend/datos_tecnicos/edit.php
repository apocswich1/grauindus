<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>datos_tecnicos">Datos Técnicos &gt;&gt;</a></li>
      <li>Editar Datos Técnicos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Datos Técnicos</h3></div>
	
    
    
    <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado</label>
		<div class="controls">
		    <select name="estado">
                    <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>Activo</option>
                    <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>No Ativo</option>
            </select>
	
		</div>
	</div>

    
	 
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->datos_tecnicos?>" placeholder="Nombre" />
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
        document.form.nom.focus();
        }
    );
    
</script>
</div>
