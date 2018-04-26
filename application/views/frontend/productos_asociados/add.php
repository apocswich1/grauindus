<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>productos_asociados/index">Productos Asociados &gt;&gt;</a></li>
      <li>Agregar Producto</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Producto</h3></div>
	
    
<div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="id_cliente">
                <option value="0">Seleccione......</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<textarea id="contenido3" name="des" placeholder="Descripción"><?php echo set_value('des'); ?></textarea>
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
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
