<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>fast">Fast Track &gt;&gt;</a></li>
      <li>Agregar Fast Track</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Agregar Fast Track</h3></div>
	
   
        <div class="control-group">
		<label class="control-label" for="usuario">Cliente que solicita <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="cliente" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormalFast();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"<?php if($_POST["cliente"]==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Contacto de empresa solicitante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="contacto" value="<?php echo set_value("contacto")?>" placeholder="Contacto de empresa solicitante" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="cantidad" value="<?php echo set_value("cantidad")?>" placeholder="Cantidad"  onkeypress="return soloNumeros(event)" />
		</div>
	</div>
    
   
     
    
    <div class="control-group">
		<label class="control-label" for="usuario">Materiales Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="materiales" style="width: 100px;">
                <option value="SI">SI</option>
                <option value="NO" selected="selected">NO</option>
            </select> 
		</div>
	</div>
    
    
     
     <div class="control-group">
		<label class="control-label" for="usuario">Empresa ejecutante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="quien_solicita" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormalFast();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"<?php if($_POST["quien_solicita"]==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
     
     <div class="control-group">
		<label class="control-label" for="usuario">Contacto de empresa ejecutante <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" id="titulo" name="contacto_empresa_ejecutante" value="<?php echo set_value("contacto_empresa_ejecutante")?>" placeholder="Contacto de empresa ejecutante" />
		</div>
	</div>
    
    
    
    
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Qué cliente externo es <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="quien_externo" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormalFast();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"<?php if($_POST["quien_externo"]==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Descripción <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<textarea id="contenido4" name="des" placeholder="Descripción"><?php echo set_value('des'); ?></textarea>
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Procesos</label>
		<div class="controls">
			 <select class="form-control chosen-select" name="procesos">
                <?php
                foreach($procesos as $proceso)
                {
                    ?>
                    <option value="<?php echo $proceso->id?>"<?php if($_POST["procesos"]==$proceso->id){echo 'selected="selected"';}?>><?php echo $proceso->nombre?> ($<?php echo number_format($proceso->precio,0,"",".")?>) (<?php echo $proceso->descripcion?>)</option>
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
        document.form.cliente.focus();
        }
    );
    
</script>
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
  <script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
	

    
</script>
</div>
