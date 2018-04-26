<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
	<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Solicitud de Cotizaciones para cliente : <?php echo $cliente->razon_social?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Solicitud de Cotizaciones para cliente : <?php echo $cliente->razon_social?></h3></div>




<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
            <th>Número</th>
            <?php if($que_buscar=='3'){?><th>N°OP</th> <?php }?>
            <th>Fecha solicitud</th>
			<th>Cliente</th>
            <th>Producto</th>
            <th>Detalle</th>
			<th>Ingeniería</th>
            <th>Fotomecánica</th>
            <th>Hoja de Costo</th>
			<th>Orden de Compra</th>
			<th>Orden de Trabajo</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        
	//	print_r($cliente->razon_social);exit;
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id);
		
		//H.C
		$hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->id);
		
		//O.C
		$ordencompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);
		//O.P
		$ordenproduccion=$this->cotizaciones_model->getOrdenDeProduccionPorCotizacion($dato->id);
		
        $cliente=$this->clientes_model->getClientePorId($dato->id_cliente); 
		?>
		<tr>
        <td><?php echo $dato->id?></td>
        <?php if($que_buscar=='3'){?><td><?php echo $dato->id_op?></td> <?php }?>
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente->razon_social; ?></td>
		<?php if($que_buscar=='5'){?><td><?php echo $dato->producto; echo '<strong> Condición: </strong>'.$dato->condicion_del_producto;?></td> <?php }?>
		<?php if($que_buscar=='4'){?><td><?php echo $dato->producto; echo '<strong> Condición: </strong>'.$dato->condicion_del_producto;?></td> <?php }?>
		<?php if($que_buscar!='5' and $que_buscar!='4'){?><td><?php echo $dato->producto ?></td> <?php }?>
        <?php //echo $dato->producto?>
        <td style="text-align: center;">
            <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            
		<td style="width: 50px;text-align: center;"><?php if(sizeof($ing)==0){echo '<i class="icon-remove"></i>';}else{echo '<i class="icon-ok"></i>';}?></td>	
        <td style="width: 50px;text-align: center;"><?php if(sizeof($fotomecanica)==0){echo '<i class="icon-remove"></i>';}else{echo '<i class="icon-ok"></i>';}?></td>
		<td style="width: 50px;text-align: center;"><?php if(sizeof($hoja) >= 1){echo '<i class="icon-ok"></i>';}else{echo '<i class="icon-remove"></i>';}?></td>
		<td style="width: 50px;text-align: center;"><?php if(sizeof($ordencompra)==0){echo '<i class="icon-remove"></i>';}else{echo '<i class="icon-ok"></i>';}?></td>
		<td style="width: 50px;text-align: center;"><?php if(sizeof($ordenproduccion)==0){echo '<i class="icon-remove"></i>';}else{echo '<i class="icon-ok"></i>';}?></td>
	    <td>
                <a href="<?php if(sizeof($hoja)==0){echo base_url()?>cotizaciones/SinOp/<?php echo $dato->id?>/<?php echo $pagina;}else{echo base_url()?>cotizaciones/rep_ajax/<?php echo $dato->id?>/<?php echo $pagina ;}?>" title="Generar Repetición" class="fancybox fancybox.ajax"><i class="icon-share"></i></a>	
      
        </td>
            <?php 
    }
            ?>
    </tbody>
   
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
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
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

