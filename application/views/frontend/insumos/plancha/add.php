<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>insumos/index/<?php echo $this->uri->segment(4)?>">Planchas &gt;&gt;</a></li>
      <li>Agregar Insumos</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Planchas</h3></div>
	
   
    
<div class="control-group">
		<label class="control-label" for="usuario">Material</label>
		<div class="controls">
			<select name="material_id">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($gramaje as $materiale)
                {
                    ?>
                    <option value="<?php echo $materiale->id?>" <?php echo set_value_select(array(),'material_id','material_id',$materiale->id)?>><?php echo $materiale->codigo?></option>
                    <?php
                }
                ?>
                            
            </select>
		</div>
	</div>
    
	
	<div class="control-group">
		<label class="control-label" for="usuario">Tipo de onda</label>
		<div class="controls">
			<select name="onda_id" id="onda_id">
                <option value="C" <?php echo set_value_select(array(),'onda_id','onda_id','C')?>>C</option>
                <option value="E" <?php echo set_value_select(array(),'onda_id','onda_id','E')?>>E</option>
            </select>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Ancho</label>
		<div class="controls">
			<input type="text" id="ancho" name="ancho" value="<?php echo set_value("nom")?>" placeholder="Ancho" />
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Largo</label>
		<div class="controls">
			<input type="text" id="largo" name="largo" value="<?php echo set_value("caracteristicas")?>" placeholder="Largo" />
		</div>
	</div>
    
 
    <div class="control-group">
		<label class="control-label" for="usuario">Stock</label>
		<div class="controls">
			<input type="text" id="stock" name="stock" value="<?php echo set_value("prercio1")?>" placeholder="Stock" onkeypress="return soloNumeros(event)" />
		</div>
	</div>
 
  <div class="control-group">
		<label class="control-label" for="usuario">Codigo</label>
		<div class="controls">
			<input type="text" id="codigo" name="codigo" value="<?php echo set_value("prercio2")?>" placeholder="Codigo" />
		</div>
	</div>
    
    
    
	<div class="control-group">
		<div class="form-actions">
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
</form>

<script type="text/javascript">

$( document ).ready(function() {
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
});
    
    
</script>
</div>
