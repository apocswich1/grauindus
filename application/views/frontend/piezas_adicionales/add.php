<?php $this->layout->element('admin_mensaje_validacion'); ?>

<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>piezas_adicionales">Piezas Adicionales &gt;&gt;</a></li>
      <li>Agregar Piezas Adicionales</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Piezas Adicionales</h3></div>
	
    

    
	<div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
			<input type="text" name="nom" value="<?php echo set_value("nom")?>" placeholder="Piezas Adicionales" required="required" />
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
                    <option value="<?php echo $unidad->id; ?>"><?php echo $unidad->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
        
    
   	<div class="control-group">
		<label class="control-label" for="usuario">Valor de Compra</label>
		<div class="controls">
			<input type="text" name="valor_compra" value="<?php echo set_value("unidad_de_medida")?>" placeholder="Valor de Compra" required="required" />
		</div>
	</div>
       
        
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Uso</label>
		<div class="controls">
		<select name="unidad_de_uso">
                <option value="0">Seleccione.....</option>
                <?php
//                $unidaduso=$this->unidades_de_compra_model->getUnidadesDeCompra();
//                foreach($unidaduso as $uso)
//                {
                    ?>
                    <option value="<?php // echo $uso->id?>"><?php // echo $uso->unidades_de_compra?></option>
                    <?php
//                }
                ?>
            </select>                           
		</div>
	</div>         -->
        
	  <div class="control-group">
		<label class="control-label" for="usuario">Proveedor</label>
		<div class="controls">
                    <select name="id_proveedor1" id="id_proveedor1">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($proveedores as $proveedor)
                {
                    ?>
                    <option value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->nombre; ?></option>
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
                    <option value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->nombre; ?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
	
   
    <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Venta</label>
		<div class="controls">
		<select name="unidad_de_venta" id="unidad_de_venta">
                <option value="0">Seleccione.....</option>
                <?php
                $unidaduso=$this->unidades_de_uso_model->getUnidadesDeUso();
                foreach($unidaduso as $uso)
                {
                    ?>
                    <option value="<?php echo $uso->id?>"><?php echo $uso->unidad_uso?></option>
                    <?php
                }
                ?>
            </select>                           
		</div>
	</div>        
    
    <div class="control-group">
		<label class="control-label" for="usuario">Unidad de Conversión</label>
		<div class="controls">
			<input type="text" id="unidad_de_conversion" name="unidad_de_conversion"  onblur="CalculoIngenieria();" value="<?php echo set_value("unidad_de_conversion")?>" placeholder="Unidad de Conversión" required="required" />
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="usuario">Valor Venta</label>
		<div class="controls">
                    <input type="text" id="valor_venta" name="valor_venta" onblur="CalculoIngenieria();" value="<?php echo set_value("valor_venta")?>" placeholder="Valor Venta" required="required" />
		</div>
	</div>
        
     <div class="control-group">
		<label class="control-label" for="usuario">Cálculo Ingeniería</label>
		<div class="controls">
                    <input type="text" readonly="true" id="calculo_ingenieria" name="calculo_ingenieria" value="<?php echo set_value("calculo_ingenieria")?>" placeholder="Cálculo Ingeniería" required="required" />
		</div>
	</div>      

     <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Modificación</label>
		<div class="controls">
                    <input type="text" readonly="true" name="fecha_modificacion" value="<?php echo date('d/m/Y'); ?>" placeholder="<?php echo date('d/m/Y'); ?>" required="required" />
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
                    <option value="<?php echo $usuario->id?>" <?php echo set_value_select($control_cartulina,'quien_sabe_ubicacion_de_la_bobina',$control_cartulina->quien_sabe_ubicacion_de_la_bobina,$usuario->id)?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
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
