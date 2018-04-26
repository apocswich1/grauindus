<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li>Emisión Orden de Producción22</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Órdenes de Producción( <?php echo sizeof($datos)?> en total)</h3></div>



<!--
<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>vendedores/add">Agregar Vendedor</a>
    <br /><br />

</div>
-->

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th>Número Cotización</th>
	      <th>Valor</th>
              <th>Fecha Emisión</th>
              <th>Fecha Entrega</th>
              <th>Tipo Entrega</th>
              <th>Forma Pago</th>
              <th>Quién Autoriza</th>
              <th>Cantidad Pedida</th>
              <th>Molde</th>
              <th>Imprimir</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $f=$this->clientes_model->getFormasPagoPorId($dato->id_forma_pago);
        $quien=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
    ?>
         <td style="width: 20px;"><?php echo $dato->id_cotizacion?></td>
         <td><?php echo $dato->valor?></td>
         <td><?php echo fecha($dato->fecha)?></td>
	 <td><?php echo fecha($dato->fecha_20_dias)?></td>
         <td><?php echo $dato->tipo_entrega?></td>
         <td><?php echo $f->forma_pago?></td>
         <td><?php echo $quien->nombre?></td>
         <td><?php echo $dato->cantidad_pedida?></td>
         <td>
            <?php
            switch($dato->tiene_molde)
            {
                case 'NO':
                    $molde=$this->moldes_model->getMoldesPorId($dato->id_molde);
                    echo $molde->nombre." (".$molde->numero.") - (Molde Antiguo)";
                break;
                case 'SI':
                    $molde=$this->moldes_model->getMoldesPorId($dato->id_molde);
                    echo $molde->nombre." (".$molde->numero.") (Molde Nuevo)";
                break;
                case 'NO LLEVA':
                    echo "NO LLEVA MOLDE";
                break;
            }
            
            ?>
         </td>
        <td style="text-align: center;">
        <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $dato->id_cotizacion?>/<?php echo $dato->id?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a>
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

