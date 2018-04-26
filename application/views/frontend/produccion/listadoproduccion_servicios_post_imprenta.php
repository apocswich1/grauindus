<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Servicios Post Imprenta( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Producto</th>
              <th>Trbajo Externo</th>
              <th>Tamaño cartulina</th>             
              <th>Cantidad Pliegos</th>
			  <th>Fecha Recepcion</th>
			  <th>Total o Parcial</th>
			  <th>Parcial 1</th>
			  <th>Parcial 2</th>
			  <th>Parcial 3</th>
			  
			  <th>Cuando</th>

		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 20px;"><?php echo $dato->descripcion_trabajo_externo?></td>
		 <td style="width: 20px;"><?php echo $dato->tamano_cartulina?></td>
		 <td style="width: 20px;"><?php echo $dato->cantidad_de_pliegos?></td>
		 <td style="width: 20px;"><?php echo $dato->fecha_recepcion_pedido?></td>
		 <td style="width: 20px;"><?php echo $dato->total_o_parcial?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_1?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_2?></td>
		 <td style="width: 20px;"><?php echo $dato->can_despacho_3?></td>
	
		 <td style="width: 20px;"><?php echo $dato->cuando?></td>
		
		 
		 
		 

       

       
       
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