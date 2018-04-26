<?php $this->layout->element('admin_mensaje_validacion'); ?>

 
<?php echo form_open(base_url()."cotizaciones/buscar_respuesta", array('onsubmit'=>'verificaCampos()','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Buscar Cotización</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Buscar Cotización</h3></div>
	
    
     <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" class="chosen-select">
              
                 <option value="0">Seleccione</option>
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
		<label class="control-label" for="usuario">Término o Palabra</label>
		<div class="controls">
			<input type="text" class="form-control" name="buscar" value="<?php echo set_value("buscar")?>" placeholder="Término o Palabra" />
		</div>
	</div> 
     
    
    
    <div class="control-group">
		<div class="form-actions">
			<!--
<button  class="btn" onclick="verificaCampos2()">Guardar</button>
-->
        <button type="submit" class="btn" title="Guardar">Guardar</button>
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

