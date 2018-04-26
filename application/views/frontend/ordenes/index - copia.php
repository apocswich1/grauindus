<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
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
		      <th>Cliente</th>
              <th>Producto</th>
              <th>Fecha</th>
              <th>Detalle Cotización</th>
              <th>Editar Orden de Trabajo</th>
              <th>Revisar Orden de Trabajo</th>
              <th>Detalle Orden de Trabajo</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $coti=$this->cotizaciones_model->getCotizacionPorId($dato->id_cotizacion);
        $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
    ?>
        <td style="width: 20px;"><?php echo $dato->id_cotizacion?></td>
		<td><?php echo $cli->razon_social?></td>	
        <td><?php echo $coti->producto?></td>
        <td><?php echo fecha($dato->fecha)?></td>
         <td style="text-align: center;width: 100px;">
              <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $dato->id_cotizacion?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
        </td>
         <td style="text-align: center;width: 100px;">
              <a href="<?php echo base_url()?>ordenes/edit/<?php echo $dato->id?>/<?php echo $pagina?>"><i class="icon-pencil"></i></a>	
        </td>
        
        <td style="text-align: center;width: 100px;">
              <a href="<?php echo base_url()?>ordenes/revision/<?php echo $dato->id?>/<?php echo $pagina?>"><i class="icon-plus"></i></a>	
        </td>
       <td style="text-align: center;width: 100px;">
              <a href="<?php echo base_url()?>ordenes/detalle_pdf/<?php echo $dato->id_cotizacion?>/<?php echo $dato->id?>" target="_blank"><i class="icon-file"></i></a>	
        </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="8" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>


