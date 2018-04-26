<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Desgajado( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Producto</th>
              <th>Operador</th>
              <th>Cliente</th>             
              <th>Fecha</th>
			  <th>Unidades de cajas por Pliego</th>
			  <th>Total Piezas por Pliego</th>
			  <th>Total a Entregar</th>
			  <th>Total Desgajado</th>
			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		//->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando")
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 150px;"><?php echo $dato->nombre?></td>
		 <td style="width: 6000px;"><?php echo $dato->razon_social?></td>
		 
		 <td style="width: 150px;"><?php echo $dato->cuando?></td>
		 <td style="width: 150px;"><?php echo $dato->unidades_de_caja_por_pliego?></td>
		 <td style="width: 150px;"><?php echo $dato->total_piezas_por_pliego?></td>
		 <td style="width: 150px;"><?php echo $dato->total_cajas_a_entregar?></td>
		 <td style="width: 150px;"><strong><?php echo $dato->total_desgajado?></strong></td>
		 
		 
		 

       

       
       
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