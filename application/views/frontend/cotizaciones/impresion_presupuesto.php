<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Impresión de Presupuesto</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Impresión de Presupuesto</h3></div>
    
    <p>
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
            <li>Cliente : <b><?php echo $cliente?></b></li>
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Id Antiguo : <b><?php echo $datos->id_antiguo?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
        </ul>
    </p>
    </p>
	
      <div class="control-group">
		<label class="control-label" for="usuario">Precio Final de Presupuesto</label>
		<div class="controls">
            
            <input type="text" name="precio_final" id="precio_final" value="<?php echo $impresionPresupuesto->precio_final?>" placeholder="Precio Final de Presupuesto" readonly="readonly" />
        
		</div>
	</div>
    
        <div class="control-group">
		<label class="control-label" for="usuario">Precio Empresa <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            
            <input type="text" name="precio_real" id="precio_final" value="<?php echo $impresionPresupuesto->precio_final?>" placeholder="Precio Empresa" />
        
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Días Entrega</label>
		<div class="controls">
            
            <input type="text" name="dias_entrega" value="<?php echo$impresionPresupuesto->dias_entrega?>" placeholder="Días Entrega" />
        
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
