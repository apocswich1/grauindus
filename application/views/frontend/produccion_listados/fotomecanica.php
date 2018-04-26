<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>produccion/listadoproduccion">Listados de Producción &gt;&gt;</a></li>
      <li>Producción &gt;&gt; Fotomecánica</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Producción &gt;&gt; Fotomecánica ( <?php echo $cuantos?> en total)</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar por estado</label>
		<div class="controls">
			<select name="estado" onchange="enviaSelect('produccion_fotomecanica',this.value);">
                <option value="0">Seleccione.....</option>
                <option value="1">Guardada</option>
                <option value="2">Liberada</option>
                <option value="3">Rechazada</option>
                <option value="4">Activa</option>
            </select>
		</div>
	</div>
</div>

<div>
	<a class="btn btn-danger pull-left" href="<?php echo base_url()?>produccion_listados/fotomecanica_pdf" target="_blank"><i class="icon-file"></i> Exportar a PDF</a>
    <br /><br />
<!-- Buscador -->
    <div class="pull-right">
	<form action="<?php echo base_url()?>produccion_listados/fotomecanica_search" method="post" accept-charset="utf-8" class="form-search pull-right">		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->

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

