<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>adhesivos">Adhesivos &gt;&gt;</a></li>
      <li>Agregar Adhesivos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Adhesivos</h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo set_value("codigo")?>" placeholder="Código" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor 1</label>
		<div class="controls">
			<select name="proveedor1">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>"><?php echo $prove->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Proveedor 2</label>
		<div class="controls">
			<select name="proveedor2">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove2)
                {
                    ?>
                    <option value="<?php echo $prove2->id?>" ><?php echo $prove2->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    
<div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio" value="<?php echo set_value("precio")?>" placeholder="Precio" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
	 
	
    
   
  <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Compra</label>
		<div class="controls">
			<input type="date" id="titulo" name="fecha_compra" value="<?php echo set_value("fecha_compra")?>" />
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
