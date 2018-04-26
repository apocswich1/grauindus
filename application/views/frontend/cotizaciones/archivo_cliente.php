<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Archivo de Cliente <?php echo $cliente->nombre?> de la cotización N° <?php echo $id?></li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Archivo de Cliente <?php echo $cliente->razon_social?> de la cotización N° <?php echo $id?></h3></div>
	
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
            <input type="text" id="link" name="nom" value="<?php echo $cliente->razon_social?>" readonly="true" />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Archivo</label>
		<div class="controls">
            <input type="file" id="file" name="file" />
		</div>
	</div>
    
    <div class="control-group">
		<div class="form-actions">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
			<button type="submit" class="btn">Guardar</button>
		</div>
	</div>
    
</div>


