<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones">Cotizaciones &gt;&gt;</a></li>
      <li>Solicitud de Cotizaciones que Solicitan Muestra ( <?php echo $cuantos?> en total)</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Solicitud de Cotizaciones que Solicitan Muestra ( <?php echo $cuantos?> en total)</h3></div>





<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
            <th>N° Cotización</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Fecha Liberación Fotomecánica</th>
            <th>Materialidad</th>
			<th>Medidas de la Caja</th>
            <th>Descripción</th>
            <th>Cotización</th>
              <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
                <th>Estado</th>
                <?php
              }
              ?>
            
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        
            $coti=$this->cotizaciones_model->getCotizacionPorId($dato->id_cotizacion);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id_cotizacion);
            $cli=$this->clientes_model->getClientePorId($coti->id_cliente);
            $vendedor=$this->usuarios_model->getUsuariosPorId($coti->id_vendedor);
    ?>
    <tr>
        <td><?php echo $dato->id_cotizacion?></td>
        <td><?php echo $cli->razon_social?></td>
        <td><?php echo $vendedor->nombre?></td>
        <td>
            <?php
            $quienFotomecanica=$this->usuarios_model->getUsuariosPorId($fotomecanica->quien);
            echo $quienFotomecanica->nombre;
            ?>
            <br />
            <?php echo $fotomecanica->cuando?>
        </td>
        <td><?php
        switch($dato->materialidad_eleccion)
        {
            case 'tapa_mono':
                ?>
                Tapa : <?php echo $dato->materialidad_1?>
                <br />
                MonoTapa :  <?php echo $dato->materialidad_2?>
                <?php
            break;
             case 'mono_mono':
                ?>
                MonoTapa : <?php echo $dato->materialidad_1?>
                <br />
                MonoTapa :  <?php echo $dato->materialidad_2?>
                <?php
            break;
             case 'tapa_tapa':
                ?>
                Tapa : <?php echo $dato->materialidad_1?>
                <br />
                Tapa :  <?php echo $dato->materialidad_2?>
                <?php
            break;
        }
        
        ?>
      </td>
        <td>
            Ancho: <strong><?php echo $dato->medidas_de_la_caja;?></strong>
            <br /> 
           Largo: <strong><?php echo $dato->medidas_de_la_caja_2;?></strong> 
            <br /> 
            Alto : <strong><?php echo $dato->medidas_de_la_caja_3;?></strong> 
            <br /> 
             Tapa: <strong><?php echo $dato->medidas_de_la_caja_4;?></strong>
        </td>
        <td><?php echo $dato->descripcion?></td>
	    <td style="text-align: center;">
            <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $dato->id_cotizacion?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
           
            <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
         <td style="text-align: center;">
         <?php
         switch($dato->estado)
         {
            case '0':
                ?>
                 <a href="javascript:void(0);" title="<?php echo $dato->nombre?>" onclick="LiberarSolitiaMuestra('<?php echo base_url()?>cotizaciones/solicitan_muestra_estado/<?php echo $dato->id?>/<?php echo $pagina?>');" style="color: red;font-weight: bold;">Liberar</a>
                <?php
            break;
            case '1':
            $quien=$this->usuarios_model->getUsuariosPorId($dato->quien);
                    echo "<strong>".$quien->nombre."</strong><br />";
                    ?>
                 <?php echo $dato->cuando?>
                <?php
            break;
         }
         ?>
           	
         </td>
         <?php
         }
         ?>   
		</tr>
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

