<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Productos ( <?php echo $cuantos?> en total)</h3></div>

<!--clientes-->
<!--<div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" class="chosen-select" onchange="enviaSelect('productos',this.value);">
              
                 <option value="0">Seleccione.....</option>
                <?php
//                $clientes=$this->clientes_model->getClientesNormal();
//                foreach($clientes as $cliente)
//                {
//                    ?>
                    <option value="//<?php // echo $cliente->id?>"><?php // echo $cliente->razon_social?></option>
                    //<?php
//                }
                ?>
               
            </select>
            
		</div>
	</div>-->
<!--/clientes-->
<!--tipo-->
<div class="control-group">
    <label class="control-label" for="usuario">Por Tipo</label>
    <div class="controls">
        <select name="cliente" onchange="enviaSelect('productos_tipo',this.value);">
            <option value="0">Seleccione.....</option>
            <option value="1">Normal</option>
            <option value="2">Genérico</option>  
        </select>            
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="usuario">Por Cliente</label>
    <div class="controls">
        <select name="cliente" class="chosen-select" onchange="enviaSelect('productos',this.value);">
            <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
        </select>            
    </div>
</div>
<!--/tipo-->
	<!-- Buscador -->
    <div class="pull-right">
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
	    <th>Molde</th>            
	    <th>Archivo</th>            
	    <th>Datos Extras</th>            
            <th>Cliente</th>
            <th>Fecha</th>
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
    //$extras=$this->productos_model->getProductosDatosExtras('4634A564');
    //print_r($extras); exit();
        
    ?>
            <td><a href="<?php echo base_url();?>productos/edit/<?php echo $dato->id?>"><?php echo $dato->codigo?></a></td>
            <td><?php echo $dato->id_cotizacion?></td>
            <!--<td><?php // echo $orden->id?></td>-->
            <td><?php echo $dato->nombre?></td>
            <td><?php echo $dato->molde?></td>
            <td><?php if($dato->archivo!=""){ ?>
            <a href='<?php echo base_url().$this->config->item('direccion_pdf').$dato->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF archivo molde" title="PDF archivo molde"></i></a>    
            <?php } ?>
            </td>
            <!--<td style="text-align: center"><?php// if($dato->id==""){echo "<label onclick=carga_ajax_productos_extras('productos/ajax_extra_productos2','".$dato->codigo."','extras'); data-toggle='modal' data-target='#myModal'>Precios</label>";}else{echo "<label onclick=carga_ajax_productos_extras('productos/ajax_extra_productos','".$dato->codigo."','extras'); data-toggle='modal' data-target='#myModal'>Precios</label>";}//echo $dato->nombre?></td>-->
            <td style="text-align: center"><?php if($dato->id==""){echo "<label onclick=carga_ajax_productos_extras_gen('productos/ajax_extra_productos3','".$coti->id_cliente."','extras'); data-toggle='modal' data-target='#myModal'>Precios</label>";}else{echo "<label onclick=carga_ajax_productos_extras_gen('productos/ajax_extra_productos3','".$coti->id_cliente."','extras'); data-toggle='modal' data-target='#myModal'>Precios</label>";}//echo $dato->nombre?></td>
            <!--
            <td><a href="<?php // echo base_url()?>productos/por_cliente/<?php // echo $cliente->id?>"><?php // echo $cliente->razon_social?></a></td>
            -->
            <td>
            <?php $cliente=$this->clientes_model->getClientePorId($coti->id_cliente);?>
            <?php echo $cliente->razon_social;?> </td>
            <td><?php echo $dato->cuando; ?></td>
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
    
<style type="text/css">
    .modal{
        margin-left: -600px;
        width: 1300px;
    }
</style>
<!-- Modal content-->
<div class="container" style="width: 1300px;">
  
  <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="width: 1300px;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
          <div id="extras" class="modal-body" style="width: 1250px">
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" value="" id="reporte">Imprimir</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
      <input type="hidden" value="" name="rutareporte" id="rutareporte">
  </div>
  
</div>
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