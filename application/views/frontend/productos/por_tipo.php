<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>productos/">Productos &gt;&gt;</a></li>
      <li>Resultados para Productos de tipo : <?php if($id==1){echo 'Normal';}else{echo 'Genéricos';}?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para Productos de tipo : <?php if($id==1){echo 'Normal';}else{echo 'Genéricos';}?></h3></div>
<!--tipo-->
<div class="control-group">
		<label class="control-label" for="usuario">Por Tipo</label>
		<div class="controls">
			<select name="cliente" onchange="enviaSelect('productos_tipo',this.value);">
              <option value="0">Seleccione.....</option>
              <option value="1" <?php if($id==1){echo 'selected="true"';}?>>Normal</option>
              <option value="2" <?php if($id==2){echo 'selected="true"';}?>>Genérico</option>  
            </select>
            
		</div>
	</div>
<!--/tipo-->
	<!-- Buscador -->
        <div class="pull-right"></br>
	<?php echo form_open(base_url()."productos/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
            <th>Código</th>
            <!--<th>OP</th>-->
            <th>Cotización</th>
	    <th>Producto</th>            
            <th>Cliente</th>
            <th>Tipo</th>
		</tr>
	</thead>
	<tbody>
    <?php
//    print_r($datos);
    foreach($datos as $dato)
    {
        $orden=$this->orden_model->getOrdenesPorCotizacion($dato->id_cotizacion);
        $coti=$this->cotizaciones_model->getCotizacionPorId($dato->id_cotizacion);
        
    ?>
            <td><a href="<?php echo base_url();?>productos/edit/<?php echo $dato->id?>"><?php echo $dato->codigo?></a></td>
            <td><?php echo $dato->id_cotizacion?></td>
            <!--<td><?php // echo $orden->id?></td>-->
            <td><?php echo $dato->nombre?></td>
            <!--
            <td><a href="<?php // echo base_url()?>productos/por_cliente/<?php // echo $cliente->id?>"><?php // echo $cliente->razon_social?></a></td>
            -->
            <td>
            <?php $cliente=$this->clientes_model->getClientePorId($coti->id_cliente);?>
            <?php echo $cliente->razon_social;?> </td>
            <td><?php echo $dato->productos_tipo; ?></td>
            
            <!--<td style="width: 100px;"><a href="<?php // echo base_url()?>productos/por_tipo/<?php // echo $dato->tipo?>"><?php // echo $dato->productos_tipo?></a>&nbsp;&nbsp;<a href="<?php // echo base_url()?>productos/change/<?php // echo $dato->id?>/<?php // echo $pagina?>" class="fancybox fancybox.ajax"><img src="<?php // echo base_url()?>public/frontend/images/edit.png" style="width: 16px;height: 16px;" /></a></td>-->
			
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