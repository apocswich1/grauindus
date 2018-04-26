<?php $this->layout->element('admin_mensaje_validacion'); ?>

 
<?php echo form_open(base_url()."cotizaciones/buscar2_respuesta", array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>cotizaciones/buscar2">Buscar Cotizaciones &gt;&gt;</a></li>
      <li>Agregar Cotización por Cliente basándose en las últimas generadas</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Cotización por Cliente basándose en las últimas generadas</h3></div>
	
    
     <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" class="chosen-select">
                <?php
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
		<label class="control-label" for="usuario">Condición del Producto</label>
		<div class="controls">
			<select name="condicion_del_producto">
                <option value="0">Nuevo</option>
                <option value="1">Repetición Sin Cambios</option>
                <option value="2">Repetición Con Cambios</option>
                <option value="3">Producto Genérico</option>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Qué buscar</label>
		<div class="controls">
			<select name="que_buscar" onchange="cambiaBuscador(this.value);">
                <option value="1">Término o Palabra</option>
                <option value="2">Número de Cotización o ID Antiguo</option>
                <option value="3">Número de Orden de Producción</option>
				<option value="4">Número Molde</option>
				<option value="5">Nombre Molde</option>
				<option value="6">Nombre Producto</option>
				<option value="7">Número Producto</option>
            </select>
		</div>
	</div>
    
   <div id="termino" style="display: block;">
    <div class="control-group">
		<label class="control-label" for="usuario">Término o Palabra</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar" value="<?php echo set_value("buscar")?>" placeholder="Término o Palabra" />
		</div>
	</div> 
   </div>
   
   <div id="numero" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Cotización o ID Antiguo</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar2" value="<?php echo set_value("buscar2")?>" placeholder="Número de Cotización o ID Antiguo" onkeypress="return alpha_con_numeros(event)" />
		</div>
	</div> 
   </div>
    
   <div id="op" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Orden de Producción</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar3" value="<?php echo set_value("buscar3")?>" placeholder="Número de Orden de Producción" onkeypress="return alpha_con_numeros(event)" />
		</div>
	</div> 
   </div> 
   
   <div id="NMolde" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Número Molde</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar4" value="<?php echo set_value("buscar4")?>" placeholder="Número Molde"  />
		</div>
	</div> 
   </div> 
   
   <div id="NomMolde" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Molde</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar5" value="<?php echo set_value("buscar5")?>" placeholder="Nombre Molde" />
		</div>
	</div> 
   </div>  
   
 <div id="NomProducto" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar7" value="<?php echo set_value("buscar7")?>" placeholder="Nombre Molde" />
		</div>
	</div> 
   </div>     
   
    <div id="NProducto" style="display: none;">
    <div class="control-group">
		<label class="control-label" for="usuario">Numero Producto</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar8" value="<?php echo set_value("buscar8")?>" placeholder="Nombre Molde" />
		</div>
	</div> 
   </div>     
   
   <div class="control-group" id="tipomolde" style="display: none;">
		<label class="control-label" for="usuario">Tipo Molde</label>
		<div class="controls">
			<select name="buscar6" onchange="cambiaBuscador(this.value);">
				<option value="7">Normal</option>
				<option value="8">Genérico</option>
            </select>
		</div>
	</div>   
	
    <div class="control-group">
		<div class="form-actions">
			
<button  class="btn" type="submit">Buscar</button>

		</div>
	</div>
    
</div>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

