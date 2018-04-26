<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>adhesivos/index/<?php echo $pagina?>">Adhesivos &gt;&gt;</a></li>
      <li>Editar Adhesivos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Adhesivos</h3></div>
	
    <div class="control-group">
		<label class="control-label" for="id_antiguo">Estado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		    <select name="estado">
                    <option value="1" <?php if($datos->estado==1){echo 'selected="true"';}?>>Rechazado</option>
                    <option value="0" <?php if($datos->estado==0){echo 'selected="true"';}?>>Liberado</option>
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
		<label class="control-label" for="usuario">Código</label>
		<div class="controls">
			<input type="text" id="titulo" name="codigo" value="<?php echo $datos->codigo?>" placeholder="Código" />
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
                    <option value="<?php echo $prove->id?>" <?php if($datos->proveedor1==$prove->id){echo 'selected="true"';}?>><?php echo $prove->nombre?></option>
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
                    <option value="<?php echo $prove2->id?>" <?php if($datos->proveedor2==$prove2->id){echo 'selected="true"';}?>><?php echo $prove2->nombre?></option>
                    <?php
                }
                ?>
                
            </select>
		</div>
	</div>
    
    
<div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
			<input type="text" id="titulo" name="precio" value="<?php echo $datos->precio?>" placeholder="Precio" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
	 
	
    
   
  <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Compra</label>
		<div class="controls">
			<input type="date" id="titulo" name="fecha_compra" value="<?php echo $datos->fecha_compra?>" />
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
    
</script>
</div>
