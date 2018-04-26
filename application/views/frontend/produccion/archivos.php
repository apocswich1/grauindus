<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
      <li>Archivos Ingeniería y Fotomecánica, de cotización N° <?php echo $id?></li>
    </ol>
   <!-- /Migas -->
    <div class="page-header"><h3>Archivos Ingeniería y Fotomecánica, de cotización N° <?php echo $id?></h3></div>
            
	<p>
         
    </p>
	<?php
    if(empty($ing->archivo))
    {
        ?>
        <div class="control-group">
    		<label class="control-label" for="usuario">PDF de Ingeniería</label>
    		<div class="controls">
    			<input type="file" id="file" name="file" /> 
    		    <input type="hidden" name="pdf_ing" value="NO" />  
            </div>
	   </div>
        <?php
    }else
    {
        ?>
        <div class="control-group">
    		<label class="control-label" for="usuario">PDF de Ingeniería</label>
    		<div class="controls">
                <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                <input type="hidden" name="file" value="<?php echo $ing->archivo?>" />
    			<input type="hidden" name="pdf_ing" value="SI" />
    		</div>
	   </div>
        <?php
    }
    ?>
    
    
    <?php
    if(empty($fotomecanica->archivo))
    {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">PDF de Fotomecánica</label>
		<div class="controls">
			<input type="file" id="file" name="file2" /> 
            <input type="hidden" name="pdf_fotomecanica" value="NO" />
		</div>
	</div>
        <?php
    }else
    {
        ?>
        <div class="control-group">
    		<label class="control-label" for="usuario">PDF de Fotomecánica</label>
    		<div class="controls">
                <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
                <input type="hidden" name="file2" value="<?php echo $fotomecanica->archivo?>" />
    			<input type="hidden" name="pdf_fotomecanica" value="SI" />
    		</div>
	   </div>
        <?php
    }
    ?>
    
    
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
           	<input type="submit" value="Guardar" class="btn tbn-default"/>
		</div>
	</div>
</form>

<script type="text/javascript">
     jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>
