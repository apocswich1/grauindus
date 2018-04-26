<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>variables_cotizador">Variables Cotizador &gt;&gt;</a></li>
      <li>Editar Variables Cotizador</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Variables Cotizador</h3></div>
	
    
   
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="Pre-Impresión" <?php if($datos->tipo=="Pre-Impresión"){echo 'selected="selected"';}?>>Pre-Impresión</option>
                <option value="Producción" <?php if($datos->tipo=="Producción"){echo 'selected="selected"';}?>>Producción</option>
                <option value="Costos Varios" <?php if($datos->tipo=="Costos Varios"){echo 'selected="selected"';}?>>Costos Varios</option>
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" required="required" />
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="link" name="precio" value="<?php echo $datos->precio?>" placeholder="Precio" required="required" />
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
        document.form.titulo.focus();
        }
    );
</script>
</div>
