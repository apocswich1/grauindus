<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Bobinado Cartulina Estado( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
			  
			  <th>Prioridad</th>
			  <th>Fecha Liberacion</th>
			  <th>Número Orden</th>
			  <th>Cliente</th>
			  <th>Detalle</th>
			  <th>Fecha OP</th>
			  <th>Descripcion de la Cartulina</th>
			  <th>Gramaje</th>
			  <th>Ancho</th>   
			  <th>Largo a Cortar</th>   
			  <th>Cantidad Pliego</th>   
			  <th>Kilos</th>   
			  <th>Entregas Parciales</th>   
			  <th>Vendedor</th>   
			  <th>Estado</th>   

		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
   $hayparcial=$this->produccion_model->getParcialBobinadoCartulina($dato->id_nodo);
		
    ?>
		 <td style="width: 6000px;">Prioridad </td>
		 <td style="width: 20px;"><?php echo $dato->cuando?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
		 <td style="width: 6000px;"><?php echo $dato->razon_social?></td>
		 <td style="width: 6000px;"><?php echo $dato->descripcion_del_trabajo?></td>
		 <td style="width: 20px;"><?php echo $dato->opcuando?></td>	 
         <td style="width: 6000px;"><?php echo $dato->descripcion_cartulina?></td>
		 
		 <td style="width: 20px;"><?php echo $dato->gramaje_seleccionado?></td>
		 <td style="width: 20px;"><?php echo $dato->ancho_a_bobinar?></td>
		 <td style="width: 20px;"><?php echo $dato->medida_final_pliego_a_cortar?></td>
		 <td style="width: 20px;"><?php echo $dato->total_pliegos_para_la_orden?></td>
		 <td style="width: 20px;"><?php echo $dato->total_kilos?></td>
		 
		 <td style="width: 20px;"><?php if(sizeof($hayparcial) >= 1){echo 'SI';}else{echo 'NO';}?></td>
		 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
		 <td style="width: 20px;"><?php if($dato->estado == 0){echo 'Abierto';} if($dato->estado == 1){echo 'Liberado';} if($dato->estado == 2){echo 'Rechazado';} if($dato->estado == 3){echo 'Parcial por liberar';} ?></td>
	
		 
		 
		
		 
		 
		 

       

       
       
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