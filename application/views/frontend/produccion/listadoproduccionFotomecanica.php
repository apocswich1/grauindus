<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Listado de Producción Fotomecanica( <?php echo sizeof($datos)?> en total)</h3></div>


<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th>Prioridad</th>
              <th>Número Orden</th>

             
    
              <th>Cliente</th>
              <th>Detallle</th>

			<th>Fecha Emisión</th>
			<th>Vendedor</th>
			<th>Estado</th>



              <th>Imprimir OP</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		
		$bodega=$this->produccion_model->getBodegaPorTipo(1,$dato->id);
		
		
		if($bodega->estado != '4')
		{
        $f=$this->clientes_model->getFormasPagoPorId($dato->id_forma_pago);
        $quien=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
		$estadoFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($dato->id);
    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 150px;"><?php echo $dato->id_op?></td>

         
	   
         <td><?php echo $dato->razon_social?></td>
         <td><?php echo $dato->nombre_producto_normal?></td>
         <td><?php echo fecha($dato->fecha)?></td>
         <td><?php echo $dato->nombre?></td>
         <td><?php if(sizeof($estadoFotomecanica) == 0){echo 'Activa';}else{echo $estadoFotomecanica->situacion;}?></td>


        <td style="text-align: center;">
        <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $dato->id?>/<?php echo $dato->id_op?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
        </td> 
       
    </tbody>
    <?php
	}
    }
    ?>
	
	   <?php
	   //Fast  track
	   
	$fast_track=$this->fast_track_model->getProcesosPorFastTrackFotomecanica('Produccion Fotomecanica');
    foreach($fast_track as $fast_tracks)
    {		
       if($fast_tracks->estado == 1) 
	   {

    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 150px;"><strong><?php echo 'Fast Track N:'.$fast_tracks->id_fast_track?></strong></td>

         
	   
         <td><strong><?php echo $fast_tracks->razon_social?></strong></td>
         <td><strong><?php if($fast_tracks->descripcion == ''){echo 'Sin Detalles en Fast Track';}else{echo $fast_tracks->descripcion;}?></td>
         <td><strong><?php echo fecha($fast_tracks->fecha)?></td>
         <td><strong><?php echo 'Contacto Solicita: '.$fast_tracks->contacto?></td>
         <td><strong><?php if($fast_tracks->estado == 0){echo 'Pendiente';}else{echo 'Liberada';}?></td>


        <td style="text-align: center;">
        
		<a href="<?php echo base_url()?>fast/imprimir/<?php echo $fast_tracks->id_fast_track?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
        </td> 
       <?php
	   }
	   ?>
    </tbody>
    <?php
    }
    ?>
	
	
	
	
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>