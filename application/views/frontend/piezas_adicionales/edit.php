<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php 
if ($datos->fecha_modificacion!="")
{ 
      $arreglo_fecha=explode('-',$datos->fecha_modificacion);  
      $fecha=$arreglo_fecha[2].'/'.$arreglo_fecha[1].'/'.$arreglo_fecha[0];
}   ´
?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>piezas_adicionales">Piezas Adicionales &gt;&gt;</a></li>
      <li>Editar Piezas Adicionales</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Editar Piezas Adicionales</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<input type="text" id="titulo" name="nom" value="<?php echo $datos->piezas_adicionales?>" placeholder="Piezas Adicionales" required="required" />
		</div>
	</div>
        
      <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Compra</label>
		<div class="controls">
			<select name="unidad_de_compra" id="unidad_de_compra">
                <option value="0">Seleccione.....</option>
                <?php
                $unidads=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidads as $unidad)
                {
                    ?>
                    <option value="<?php echo $unidad->id; ?>" <?php if($unidad->id==$datos->unidad_de_compra){echo 'selected="selected"';}?> ><?php echo $unidad->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>       


    <div class="control-group">
		<label class="control-label" for="usuario">Valor Compra</label>
		<div class="controls">
			<input type="text" name="valor_compra" value="<?php echo $datos->valor_compra; ?>" placeholder="Valor Compra" required="required" />
		</div>
	</div>     

        	  <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
                    <select name="id_proveedor1" id="id_proveedor1">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $proveedor)
                {
                    ?>
                    <option value="<?php echo $proveedor->id; ?>"<?php if($proveedor->id==$datos->id_proveedor1){echo 'selected="selected"';}?> ><?php echo $proveedor->nombre; ?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>

	  <div class="control-group">
		<label class="control-label" for="usuario">Proveedor 2</label>
		<div class="controls">
                    <select name="id_proveedor2" id="id_proveedor2">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $proveedor)
                {
                    ?>
                    <option value="<?php echo $proveedor->id; ?>"<?php if($proveedor->id==$datos->id_proveedor2){echo 'selected="selected"';}?> ><?php echo $proveedor->nombre; ?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
        
        
    <!--
    	<div class="control-group">
		<label class="control-label" for="usuario">Unidad de Medida</label>
		<div class="controls">
			<input type="text" name="unidad_de_medida" value="<?php //echo $datos->unidad_de_medida?>" placeholder="Unidad de Medida" required="required" />
		</div>
	</div>
    -->
	   <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Venta</label>
		<div class="controls">
		<select name="unidad_de_venta">
                <option value="0">Seleccione.....</option>
                <?php
                $unidadventas=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidadventas as $unidadventa)
                {
                    ?>
                    <option value="<?php echo $unidadventa->id?>" <?php if($unidadventa->id==$datos->unidad_de_venta){echo 'selected="selected"';}?>><?php echo $unidadventa->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
	
    <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Conversión</label>
		<div class="controls">
			<input type="text" id="unidad_de_conversion" name="unidad_de_conversion"  onblur="CalculoIngenieria();" value="<?php echo $datos->unidad_de_conversion; ?>" placeholder="Unidad de Conversión" required="required" />
		</div>
	</div>    
    
  

	
	<div class="control-group">
		<label class="control-label" for="usuario">Valor Venta</label>
		<div class="controls">
                    <input type="text" id="valor_venta" name="valor_venta" onblur="CalculoIngenieria();" value="<?php echo $datos->valor_venta; ?>" placeholder="Valor Venta" required="required" />
		</div>
	</div>
        
     <div class="control-group">
		<label class="control-label" for="usuario">Cálculo Ingeniería</label>
		<div class="controls">
                    <input type="text" readonly="true" id="calculo_ingenieria" name="calculo_ingenieria" value="<?php echo $datos->calculo_ingenieria; ?>" placeholder="Cálculo Ingeniería" required="required" />
		</div>
	</div>      

     <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Modificación</label>
		<div class="controls">
                    <input type="text" readonly="true" name="fecha_modificacion" value="<?php echo $fecha; ?>" required="required" />
		</div>
	</div>     

    <div class="control-group">
		<label class="control-label" for="quien_sabe_ubicacion_de_la_bobina">Quien lo modifico<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="id_user" id="id_user"  class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($usuario->id==$datos->id_user){echo 'selected="selected"';}?> ><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
 
    
	<div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $datos->id?>" />
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
