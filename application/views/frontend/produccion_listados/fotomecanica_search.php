<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>produccion/listadoproduccion">Listados de Producción &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>produccion_listados/fotomecanica">Producción &gt;&gt; Fotomecánica &gt;&gt;</a></li>
      <li>Producción &gt;&gt; Fotomecánica Búsqueda</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Producción &gt;&gt; Fotomecánica ( <?php echo $cuantos?> en total)</h3></div>




<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
              <th>Prioridad</th>
              <th>Número cotización</th>
              <th>Número Orden</th>
              <th>Cliente</th>
              <th>Detalle</th>
              <th>Fecha Emisión</th>
			  <th>Vendedor</th>
			  <th>Estado</th>
              <th>Imprimir OP</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $orden=$this->orden_model->getOrdenesPorCotizacion($dato->id_nodo);
        $cotizacion=$this->cotizaciones_model->getCotizacionPorId($dato->id_nodo);
        $cli=$this->clientes_model->getClientePorId($cotizacion->id_cliente);
        $cliente=$cli->razon_social;
        $vendedor=$this->vendedores_model->getVendedorPorId($cotizacion->id_vendedor);
    ?>
        <tr>
        <td>
            <?php
            switch($dato->prioridad)
            {
                case '0':
                    ?>
                    <span style="font-weight: bold; color: blue;">Normal</span>
                    <?php
                break;
                case '1':
                    ?>
                    <span style="font-weight: bold; color: red;">Alta</span>
                    <?php
                break;
            }
            ?>
        </td>
        <td><?php echo $dato->id_nodo?></td>
        <td><?php echo $orden->id?></td>
	    <td><?php echo $cliente?></td>
        <td><?php echo $orden->nombre_producto_normal?></td>
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $vendedor->nombre?></td>    
        <td>
             <?php
            //0 abierta 1 Liberada 2 Rechazado
            switch($dato->estado)
            {
                    case '0':
                        ?>
                        <span style="font-weight: bold; color:blue">Guardada</span>
                        <?php                                                
                    break;
                    case '1':
                       ?>
                        <span style="font-weight: bold; color:green">Liberada</span>
                        <?php
                    break;
                    case '2':
                        ?>
                        <span style="font-weight: bold; color:black">Rechazada</span>
                        <?php
                    break;
                    case '3':
                        ?>
                        <span>Activo</span>
                        <?php
                    break;
                
            }
            ?>
        </td>
        <td><a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $cotizacion->id?>/<?php echo $orden->id?>" title="Imprimir" target="_blank"><i class="icon-file"></i></a></td>
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
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>

