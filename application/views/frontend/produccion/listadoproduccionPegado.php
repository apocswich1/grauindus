<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Pegado( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Operador</th>
              <th>Cliente</th>
              <th>Descripcion Trabajo</th>
              <th>Fehca</th>
			  <th>Cajas Buenas</th>
			  <th>Costo Pegado</th>
		



              <th>Imprimir Etiqueta</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		//->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando")
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
		 <td style="width: 150px;"><?php echo $dato->nombre?></td>
		 <td style="width: 150px;"><?php echo $dato->razon_social?></td>
		 <td style="width: 150px;"><?php echo $dato->descripcion_del_trabajo?></td>
		 <td style="width: 150px;"><?php echo $dato->cuando?></td>
		 <td style="width: 150px;"><?php echo $dato->cantidad_cajas_buenas?></td>
		 <td style="width: 150px;"><?php echo '$ <strong>'.$dato->pegado.'</strong> Pesos'?></td>
		 
		 

        <td style="text-align: center;">
        <a href="<?php echo base_url()?>produccion/pdf_etiqueta/<?php echo $dato->id_op?>/<?php echo $dato->orden_de_trabajo?>/<?php echo $dato->operador?>/Etiquetas" title="Imprimir" target="_blank"><i class="icon-bookmark"></i></a>
        </td> 
       

       
       
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