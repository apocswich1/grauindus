<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>insumos/index/<?php echo $this->uri->segment(4)?>">Insumos &gt;&gt;</a></li>
      <li>Agregar Insumos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Insumos</h3></div>
	
   
    
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
		<label class="control-label" for="usuario">Proveedor 3</label>
		<div class="controls">
			<select name="proveedor3">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove3)
                {
                    ?>
                    <option value="<?php echo $prove3->id?>"><?php echo $prove3->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo set_value("codigo")?>" placeholder="Código" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Material</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo set_value("nom")?>" placeholder="Nombre" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Características</label>
		<div class="controls">
			<input type="text" id="titulo" name="caracteristicas" value="<?php echo set_value("caracteristicas")?>" placeholder="Características" />
		</div>
	</div>
    
  <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Compra</label>
		<div class="controls">
			<select name="unidad_de_compra">
                <option value="0">Seleccione.....</option>
                <?php
                $unidads=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidads as $unidad)
                {
                    ?>
                    <option value="<?php echo $unidad->id?>"><?php echo $unidad->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
      <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Venta</label>
		<div class="controls">
			<select name="unidad_de_venta">
                <option value="Gramos*por m2">Gramos*por m2</option>
                <option value="Centímetros">Centímetros</option>
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Precio 1</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio1" value="<?php echo set_value("prercio1")?>" placeholder="Precio 1" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
 
  <div class="control-group">
		<label class="control-label" for="usuario">Precio 2</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio2" value="<?php echo set_value("prercio2")?>" placeholder="Precio 2" onkeypress="return soloNumeros(event)" />
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
        document.form.codigo.focus();
        }
    );
    
</script>
</div>
