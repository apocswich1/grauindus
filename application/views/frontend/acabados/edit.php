<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>acabados/index/<?php echo $pagina?>">Acabados &gt;&gt;</a></li>
      <li>Editar Acabados</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Acabado</h3></div>
	
    
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
		<label class="control-label" for="usuario">Proveedor 1</label>
		<div class="controls">
			<select name="proveedor1">
                <option value="0">Seleccione.....</option>
                <?php
                 foreach($proveedores as $prove)
                {
                    ?>
                    <option value="<?php echo $prove->id?>" <?php if($datos->proveedor_1==$prove->id){echo 'selected="selected"';}?>><?php echo $prove->nombre?></option>
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
                    <option value="<?php echo $prove2->id?>" <?php if($datos->proveedor_2==$prove2->id){echo 'selected="selected"';}?>><?php echo $prove2->nombre?></option>
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
		<label class="control-label" for="usuario">Características</label>
		<div class="controls">
			<input type="text" id="titulo" name="caracteristicas" value="<?php echo $datos->caracteristicas?>" placeholder="Características" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Tipo</label>
		<div class="controls">
			<select name="tipo">
                <option value="Externo" <?php if($datos->tipo=="Externo"){echo 'selected="selected"';}?>>Externo</option>
                <option value="Interno" <?php if($datos->tipo=="Interno"){echo 'selected="selected"';}?>>Interno</option>
            </select>
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
                    <option value="<?php echo $unidad->id?>" <?php if($datos->unidad_de_compra==$unidad->id){echo 'selected="selected"';}?>><?php echo $unidad->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
      <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Uso</label>
		<div class="controls">
			<select name="unidad_de_venta">
                <option value="0">Seleccione.....</option>
                <?php
                $unidadventas=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidadventas as $unidadventa)
                {
                    ?>
                    <option value="<?php echo $unidadventa->id?>" <?php if($datos->unidad_de_venta==$unidadventa->id){echo 'selected="selected"';}?>><?php echo $unidadventa->unidad_uso; ?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
      <div class="control-group">
		<label class="control-label" for="usuario">Procesos Especiales</label>
		<div class="controls">
                <select name="procesos_especiales">
                <option value="">Seleccione.....</option>
                <option value="1" <?php if($datos->procesos_especiales==1){echo 'selected="selected"';}?>>Si</option>
                <option value="0" <?php if($datos->procesos_especiales==0){echo 'selected="selected"';}?>>No</option>
                
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Valor Venta</label>
		<div class="controls">
			<input type="text" id="titulo" name="valor_venta" value="<?php echo $datos->valor_venta?>" placeholder="Valor Venta" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
	<!--
	<div class="control-group">
		<label class="control-label" for="usuario">Valor Venta Minima</label>
		<div class="controls">
			<input type="text" id="titulo" name="valor_venta_minima" value="<?php echo $datos->valor_venta_minima?>" placeholder="Valor Venta Minima" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label" for="usuario">Cantidad Minima</label>
		<div class="controls">
			<input type="text" id="titulo" name="cantidad_minima" value="<?php echo $datos->cantidad_minima?>" placeholder="Cantidad Minima" onkeypress="return soloNumeros(event)" />
		</div>
	</div>


	<div class="control-group">
		<label class="control-label" for="usuario">Costo Cantidad Minima</label>
		<div class="controls">
			<input type="text" id="titulo" name="costo_cantidad_minima" value="<?php echo $datos->costo_cantidad_minima?>" placeholder="Costo Cantidad Minima" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
	-->
      <div class="control-group">
		<label class="control-label" for="usuario">Costo de compra</label>
		<div class="controls">
			<input type="text" id="titulo" name="costo_compra" value="<?php echo $datos->costo_compra?>" placeholder="Costo de compra" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
<!--	 <div class="control-group">
		<label class="control-label" for="usuario">Costo Fijo</label>
		<div class="controls">
			<input type="text" id="titulo" name="costo_fijo" value="<?php echo $datos->costo_fijo?>" placeholder="Costo Fijo" onkeypress="return soloNumeros(event)" />
		</div>
	</div>-->
	
  <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Cotización</label>
		<div class="controls">
			<input type="date" id="titulo" name="fecha_cotizacion" value="<?php echo $datos->fecha_cotizacion?>" />
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
