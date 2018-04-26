<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>productos_asociados/index">Productos Asociados &gt;&gt;</a></li>
      <li>Editar Producto</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Producto</h3></div>
	
    
<div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="id_cliente">
                <option value="0">Seleccione......</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    if($datos->id_cliente==$cliente->id)
                    {
                        ?>
                    <option value="<?php echo $cliente->id?>" selected="selected"><?php echo $cliente->razon_social?></option>
                    <?php
                    }else
                    {
                        ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                    }
                    
                }
                ?>
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->nombre?>" placeholder="Nombre" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Descripción</label>
		<div class="controls">
			<textarea id="contenido3" name="des" placeholder="Descripción"><?php echo $datos->descripcion; ?></textarea>
		</div>
	</div>
    
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
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
        document.form.nom.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
