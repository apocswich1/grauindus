<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Imprenta Producción( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Producto</th>
              <th>Colores</th>
              <th>Descripcion de Tapa</th>             
              <th>Total Pliegos Buenos</th>
			  <th>Impresion para trabajar</th>
			  <th>Cantidad Parcial</th>
			  
			  
			  <th>Maestro</th>
	
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 20px;"><?php echo $dato->colores?></td>
		 <td style="width: 20px;"><?php echo $dato->tipo_cartulina?></td>
		 <td style="width: 20px;"><?php echo $dato->total_pliegos_buenos?></td>
		 <td style="width: 20px;"><?php echo $dato->impresion_para_trabajo?></td>
		 <td style="width: 20px;"><?php echo $dato->can_parcial?></td>
	
		 <td style="width: 20px;"><?php echo $dato->Maestro?></td>
		
		 
		 
		 

       

       
       
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