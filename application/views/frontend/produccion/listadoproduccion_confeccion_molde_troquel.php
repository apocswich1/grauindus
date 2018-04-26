<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Confeccion Molde Troquel ( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
		prioridad	fecha liberacion fotomecanica	numero orde	cliente	detalle	fecha OP	vendedor	estado
		
              <th>Prioridad</th>
              <th>Fecha Leberacion Fotomecanica</th>
              <th>Número Orden</th>
              <th>Cliente</th>
              <th>Detalle</th>
              <th>Fehca OP</th>           
              <th>Vendedor</th>             
              <th>Total o Parcial</th>             
                      

			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
		$fotomecanica=$this->produccion_model->getFotomecanicaPorTipo('1',$dato->id_cotizacion);

		
    ?>
         <td style="width: 20px;">Prioridad</td>
         <td style="width: 20px;"><?php echo $fotomecanica->fecha_liberada?></td>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 20px;"><?php echo $dato->razon_social?></td>
         <td style="width: 20px;"><?php echo $dato->descripcion_del_trabajo?></td>
         <td style="width: 20px;"><?php echo $dato->opcuando?></td>
         
		 
		 <td style="width: 20px;"><?php echo $dato->vennombre?></td>
		 <td style="width: 20px;"><?php echo $dato->situacion?></td>
		 

		 
		 
		 

       

       
       
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