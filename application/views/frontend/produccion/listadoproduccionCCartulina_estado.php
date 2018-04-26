<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Control Cartulina Estado( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
				
              <th>Prioridad</th>
              <th>Fecha Leberacion Fotomecanica</th>
              <th>Número Orden</th>
              <th>Cliente</th>
              <th>Detalle</th>
              <th>Fehca OP</th>
              <th>Descripcion de la tapa</th>
              <th>Gramaje</th>
              <th>Ancho</th>             
              <th>Vendedor</th>             
              <th>Entregas Parciales</th>             
              <th>Estado</th>             
                      

			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo('1',$dato->id_cotizacion);

		//->select("ppp.descripcion_de_la_tapa,usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.quien_sabe_ubicacion_de_la_bobina,ppp.ancho_de_bobina,ppp.gramaje,ppp.numero_de_bobina,ppp.total_de_bobinas,op.nombre_producto_normal,ppp.total_kilos,ppp.hay_en_stock")
    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 20px;"><?php echo $fotomecanica->fecha_liberada?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 20px;"><?php echo $dato->razon_social?></td>
         <td style="width: 20px;"><?php echo $dato->descripcion_del_trabajo?></td>
         <td style="width: 20px;"><?php echo $dato->opcuando?></td>
         <td style="width: 6000px;"><?php echo $dato->descripcion_de_la_tapa?></td>
		 <td style="width: 20px;"><?php echo $dato->gramaje?></td>
		 <td style="width: 20px;"><?php echo $dato->ancho_de_bobina?></td>
		 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
		 <td style="width: 20px;"><?php if($dato->situacion = 'Parcial'){echo 'SI';}else{echo 'NO';}?></td>
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