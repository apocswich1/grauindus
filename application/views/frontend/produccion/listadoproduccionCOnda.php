<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Litado de Orden de Producción</li>
    </ol>
   <!-- /Migas -->



<div class="page-header"><h3>Listado de Producción Control Onda( <?php echo sizeof($datos)?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              
              <th>Número Orden</th>
              <th>Descripcion de la tapa</th>
              <th>Gramaje</th>
              <th>Numero Bobina</th>             
              
			  
			  
			  <th>Comprar?</th>
			  <th>Fecha</th>
			  
			
			  
		



              
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {

		//->select("usu.nombre,cli.razon_social,ppp.cuando,op.id as id_op,ppp.ancho_de_bobina,op.nombre_producto_normal,ppp.gramaje_onda,ppp.numero_bobina_onda,ppp.hay_que_comprar_onda")
    ?>
         <td style="width: 20px;">Numero: <?php echo $dato->id_op?></td>
         <td style="width: 6000px;"><?php echo $dato->nombre_producto_normal?></td>
		 <td style="width: 20px;"><?php echo $dato->gramaje_onda?></td>
		 <td style="width: 20px;"><?php echo $dato->numero_bobina_onda?></td>
		
		
		 
		 <td style="width: 20px;"><?php echo $dato->hay_que_comprar_onda?></td>
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