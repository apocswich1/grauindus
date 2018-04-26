<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>produccion/listadoproduccion">Listados de Producción &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>produccion_listados/fotomecanica">Producción &gt;&gt; Fotomecánica &gt;&gt;</a></li>
      <li>Producción &gt;&gt; Fotomecánica por estado</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Producción &gt;&gt; Fotomecánica por situación : <?php echo $situacion?> ( <?php echo $cuantos?> en total)</h3></div>


<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar por situación</label>
		<div class="controls">
			<select name="estado" onchange="enviaSelect('produccion_fotomecanica',this.value);">
                <option value="0">Seleccione.....</option>
                <option value="1" <?php if($estado==1){echo 'selected="true"';}?>>Pendiente</option>
                <option value="2" <?php if($estado==2){echo 'selected="true"';}?>>Activa</option>
                <option value="3" <?php if($estado==3){echo 'selected="true"';}?>>Liberada</option>
                <option value="4" <?php if($estado==4){echo 'selected="true"';}?>>Cerrada</option>
                <option value="5" <?php if($estado==5){echo 'selected="true"';}?>>Guardar</option>
            </select>
		</div>
	</div>
</div>
<div>
	<a class="btn btn-danger pull-left" href="<?php echo base_url()?>produccion_listados/fotomecanica_por_estado_pdf/<?php echo $situacion?>" target="_blank"><i class="icon-file"></i> Exportar a PDF</a>
    <br /><br />


</div>

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
            switch($dato->situacion)
            {
                    case 'Pendiente':
                        ?>
                        <span style="font-weight: bold; color:red">Pendiente</span>
                        <?php                                                
                    break;
                    case 'Activa':
                       ?>
                        <span style="font-weight: bold; color:red">Activa</span>
                        <?php
                    break;
                    case 'Liberada':
                        ?>
                        <span style="font-weight: bold; color:green">Liberada</span>
                        <?php
                    break;
                    case 'Cerrada':
                        ?>
                        <span style="font-weight: bold; color:black">Cerrada</span>
                        <?php
                    break;
					case 'Guardar':
                        ?>
                        <span style="font-weight: bold; color:blue">Guardar</span>
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

