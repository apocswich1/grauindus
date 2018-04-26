<?php $this->layout->element('admin_mensaje_validacion'); ?>

 
<?php echo form_open(base_url()."cotizaciones/agregar_respuesta", array('onsubmit'=>'verificaCampos()','class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Agregar Cotización por Cliente basándose en la última generada</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Cotización por Cliente basándose en la última generada</h3></div>
	
    
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
		<div class="form-actions">
			<!--
<button  class="btn" onclick="verificaCampos2()">Guardar</button>
-->
        <button type="submit" class="btn" title="Crear Cotización">Crear Cotización</button>
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

