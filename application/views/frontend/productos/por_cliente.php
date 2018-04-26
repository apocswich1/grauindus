<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>productos/">Productos &gt;&gt;</a></li>
      <li>Resultados para el cliente <strong><?php echo $cliente->razon_social?></strong></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para el cliente <strong><?php echo $cliente->razon_social?></strong></h3></div>
<!--clientes-->
<div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" class="chosen-select" onchange="enviaSelect('productos',this.value);">
              
                 <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>" <?php if($id==$cliente->id){echo 'selected="true"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
            
		</div>
	</div>
<?php 
$cuentaProductos=$this->productos_model->getCantidadProductosPorCliente($id);
$ultimoNumero=$this->productos_model->getUltimoNumeroProductosPorCliente($id);
?>
<div class="control-group" style="float: right; z-index: 9999; margin-top: -135px; padding-right: 200px">
    <h3>Cantidad de Productos: <?php echo $cuentaProductos; ?> &nbsp;&nbsp;&nbsp;Ultimo Numero Usado: <?php echo substr($ultimoNumero->codigo,5);//print_r($ultimoNumero);?></h3>
    
</div>
<!--/clientes-->


<table class="table table-bordered table-striped indice">
    <thead>
        <tr>

            <th>Cotización</th>
            <th>OP</th>
            <th>Producto</th>
            <th>Código</th>
            <th>Cliente</th>
            <th>Tipo</th>
        </tr>
    </thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $orden=$this->orden_model->getOrdenesPorCotizacion($dato->id_cotizacion);
        $coti=$this->cotizaciones_model->getCotizacionPorId($dato->id_cotizacion);
        $cliente=$this->clientes_model->getClientePorId($coti->id_cliente);
    ?>
            <td><?php echo $dato->id_cotizacion?></td>
			<td><?php echo $orden->id?></td>
            <td><?php echo $dato->nombre?></td>
            <td><?php echo $dato->codigo?></td>
            <td><a href="<?php echo base_url()?>productos/por_cliente/<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></a></td>
            <td style="width: 100px;"><a href="<?php echo base_url()?>productos/por_tipo/<?php echo $dato->tipo?>"><?php echo $dato->productos_tipo?></a>&nbsp;&nbsp;<a href="<?php echo base_url()?>productos/change/<?php echo $dato->id?>/<?php echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url()?>public/frontend/images/edit.png" style="width: 16px;height: 16px;" /></a></td>
			
    </tbody>
    <?php
    }
    ?>
    <tr>
        <td colspan="6" style="text-align: right;">
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