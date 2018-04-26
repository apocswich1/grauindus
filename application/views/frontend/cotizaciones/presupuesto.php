<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Cierre de Presupuesto</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Cierre de Presupuesto</h3></div>
    
    <p>
        <ul>
        <?php
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
        ?>
            <li>Cliente : <?php echo $cliente?></li>
            <li>Cotización número : <?php echo $id?></li>
            <li>Fecha : <?php echo fecha($datos->fecha)?></li>
            <li>Verndedor : <?php echo $vendedor->nombre?></li>
        </ul>
    </p>
	
      <div class="control-group">
		<label class="control-label" for="usuario">Costo de Pegado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            
            <input type="text" name="costo_pegado" id="costo_pegado" placeholder="Costo Pegado" value="<?php echo $presupuesto->costo_pegado?>" />
        
		</div>
	</div>
    
      <div class="control-group">
		<label class="control-label" for="usuario">Margen <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            
            <input type="text" name="margen" onkeypress="return soloNumeros(event)" placeholder="Margen" value="<?php echo $presupuesto->margen?>" />
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costos Adicionales</label>
		<div class="controls">
            
            <input type="text" name="costos_adicionales" placeholder="Costos Adicionales" value="<?php echo $presupuesto->costos_adicionales?>" /> <input type="text" name="valor_costos_adicionales" onkeypress="return soloNumeros(event)" placeholder="Valor Costos Adicionales" value="<?php echo $presupuesto->valor_costos_adicionales?>" />
        
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Costos Adicionales 2</label>
		<div class="controls">
            
            <input type="text" name="costos_adicionales2" placeholder="Costos Adicionales 2" value="<?php echo $presupuesto->costos_adicionales2?>" /> <input type="text" name="valor_costos_adicionales2" onkeypress="return soloNumeros(event)" placeholder="Valor Costos Adicionales 2" value="<?php echo $presupuesto->valor_costos_adicionales2?>" />
        
		</div>
	</div>
  
   <div class="control-group">
		<label class="control-label" for="usuario">Comentarios</label>
		<div class="controls">
			<textarea id="contenido6" name="comentarios" placeholder="Comentarios"><?php echo $presupuesto->comentarios?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Se considera repetición sin costo</label>
		<div class="controls">
			<select name="se_considera_repeticion_sin_costo">
                 <option value="NO" <?php if($presupuesto->se_considera_repeticion_sin_costo=="NO"){echo 'selected="selected"';}?>>NO</option>
                <option value="SI" <?php if($presupuesto->se_considera_repeticion_sin_costo=="SI"){echo 'selected="selected"';}?>>SI</option>
               
            </select>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Identificación de trabajo</label>
		<div class="controls">
            
            <input type="text" name="identificacion_de_trabajo" placeholder="Identificación de trabajo" value="<?php echo $presupuesto->identificacion_de_trabajo?>" />
        
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
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.costo_pegado.focus();
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
