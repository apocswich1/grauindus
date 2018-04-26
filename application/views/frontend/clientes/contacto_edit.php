<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>clientes/index/<?php echo $pagina?>">Clientes &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>clientes/contactos/<?php echo $id?>/<?php echo $pagina?>">Contactos &gt;&gt;</a></li>
      <li>Editar Contacto a Cliente <?php echo $cliente->razon_social?></li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Contacto a Cliente <?php echo $cliente->razon_social?></h3></div>
	
    
    
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="link" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" />
		</div>
	</div>
    
    
	 <div class="control-group">
		<label class="control-label" for="usuario">E-Mail</label>
		<div class="controls">
			<input type="text" id="tele" name="correo" value="<?php echo $datos->correo; ?>" placeholder="E-Mail" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Teléfono</label>
		<div class="controls">
			<input type="text" id="tele" name="tel" value="<?php echo $datos->telefono; ?>" placeholder="Teléfono" />
		</div>
	</div>
    
   <div class="control-group">
		<label class="control-label" for="usuario">Función</label>
		<div class="controls">
			<input type="text" id="tele" name="funcion" value="<?php echo $datos->funcion; ?>" placeholder="Función" />
		</div>
	</div>

    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $ide?>" />
        <input type="hidden" name="id_cliente" value="<?php echo $id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
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
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas"
	});
</script>
</div>
