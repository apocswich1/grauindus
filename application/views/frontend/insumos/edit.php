<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>insumos/index/<?php echo $this->uri->segment(4)?>">Insumos &gt;&gt;</a></li>
      <li>Editar Insumos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Insumos</h3></div>
	
   
    
<div class="control-group">
		<label class="control-label" for="usuario">Proveedor 1</label>
		<div class="controls">
			<select name="proveedor1">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($datos->proveedor_1==$prove->id){echo 'selected="selected"';}?> ><?php echo $prove->nombre?></option>
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
                    <option value="<?php echo $prove2->id?>" <?php if($datos->proveedor_2==$prove2->id){echo 'selected="selected"';}?> ><?php echo $prove2->nombre?></option>
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
                    <option value="<?php echo $prove3->id?>" <?php if($datos->proveedor_3==$prove3->id){echo 'selected="selected"';}?> ><?php echo $prove3->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo $datos->codigo?>" placeholder="Código" />
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Material</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->material?>" placeholder="Nombre" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Características</label>
		<div class="controls">
			<input type="text" id="titulo" name="caracteristicas" value="<?php echo $datos->caracteristicas?>" placeholder="Características" />
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
                    <option value="<?php echo $unidad->id?>" <?php if($datos->unidad_de_compra==$unidad->id){echo 'selected="selected"';}?> ><?php echo $unidad->unidad_uso?></option>
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
             <?php
            switch($datos->unidad_de_venta)
            {
                case 'Gramos*por m2':
                    ?>
                   <option value="Gramos*por m2" selected="selected">Gramos*por m2</option>
                <option value="Centímetros">Centímetros</option>
                    <?php
                break;
                case 'Centímetros':
                    ?>
                   <option value="Gramos*por m2">Gramos*por m2</option>
                <option value="Centímetros" selected="selected">Centímetros</option>
                    <?php
                break;
            }
            ?>
                
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Precio 1</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio1" value="<?php echo $datos->precio1?>" placeholder="Precio 1" />
		</div>
	</div>
 
  <div class="control-group">
		<label class="control-label" for="usuario">Precio 2</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio2" value="<?php echo $datos->precio2?>" placeholder="Precio 2" />
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
        document.form.codigo.focus();
        }
    );
    
</script>
</div>
