<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>clientes/index">Clientes &gt;&gt;</a></li>
      <li>Cliente Activos</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Clientes Activos ( <?php echo $cuantos?> en total)</h3></div>

<div style="text-align: right;">
 <div class="control-group">
		<label class="control-label" for="usuario">Filtrar</label>
		<div class="controls">
		<select name="perfil" onchange="enviaSelect('clientes',this.value);">
                <option value="0">Seleccione.....</option>
                  <option value="1">Todos</option>
                  <option value="2" selected="selected">Activos</option>
                  <option value="3">No Activos</option>
            </select>
		</div>
	</div>
</div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>RUT</th>
            <th>E-Mail</th>
            <th>Vendedor</th>
			<th>Razón Social</th>
			<th>Nombre Fantasía</th>
            <th>Cupo Máximo</th>
            <th>Contactos</th>
            <th>Estado</th>
            <th>Productos</th>            
            <th>Fast Track</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    $i=1;    
    foreach($datos as $dato)
    {
        $i++;        
        $vendedor=$this->usuarios_model->getUsuariosPorId($dato->id_vendedor);
        $productos_por_cliente=$this->productos_model->getProductosPorClienteVista($dato->id);        
        
    ?>
    <tr>
    
            <td><?php echo esRut($dato->rut)?></td>
            <td><a href="<?php echo base_url();?>clientes/mensaje/<?php echo $dato->id?>" class="fancybox fancybox.ajax"><?php echo $dato->correo?></a></td>
            <td><?php echo $vendedor->nombre?></td>
			<td><?php echo $dato->razon_social?></td>
            <td><?php echo $dato->nombre_fantasia?></td>
            <td><?php echo $dato->cupo_maximo?></td>
			<td style="text-align: center;"><a href="<?php echo base_url()?>clientes/contactos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Contactos"><i class="icon-search"></i></td>
            	<!--
<td style="text-align: center;"><a href="<?php echo base_url()?>productos_asociados/clientes/<?php echo $dato->id?>/<?php echo $pagina?>" title="Productos" target="_blank"><i class="icon-barcode"></i></td>
-->
            
            <td style="text-align: center;">
                <?php
                switch($dato->estado)
                {
                    case '0':
                        ?>
                        <i class="icon-hand-up"></i>
                        <?php
                    break;
                     case '1':
                        ?>
                        <i class="icon-hand-down"></i>
                        <?php
                    break;
                }
                ?>
            </td>
            <td style="text-align: center;"> <?php if (count($productos_por_cliente)>0){ ?><a onclick="ver_informacion('producto_<?php echo $i; ?>')"><i class="icon-search"></i><?php } ?> </td> 
            <td style="text-align: center;">
                <?php
                switch($dato->fast)
                {
                    case '1':
                        ?>
                        SI
                        <?php
                    break;
                     case '0':
                        ?>
                        NO
                        <?php
                    break;
                }
                ?>
            </td>
			<td>
               <a href="<?php echo base_url()?>clientes/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>clientes/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
            </tr>
            <tr>
                <td colspan="12">
                    <div id="producto_<?php echo $i; ?>" style="display:none;"> 
                        <strong>Productos:</strong></br>
                    <?php
                        foreach($productos_por_cliente as $productos)
                        {
                            echo "<ul>";
                            $descripcion_producto=$this->productos_model->getProductosPorClienteRow($productos->codigo_prod_antiguo);
                            $cotizacion_por_producto=$this->productos_model->getProductosPorClienteCotizacionRow($productos->codigo_prod_antiguo);
                            echo "<li>  <strong>Cotización:</strong> <a href=".base_url()."cotizaciones/detalle_ajax/".$cotizacion_por_producto->id_cotizacion." class='fancybox fancybox.ajax'>".$cotizacion_por_producto->id_cotizacion." </a> <strong>Codigo:</strong> <a href=".base_url()."productos/edit/".$descripcion_producto->id.">".$productos->codigo_prod_antiguo."</a> <strong>Descripción:</strong> ".ucwords(strtolower($descripcion_producto->nombre))."</li>";
                            echo "</ul>";                                 
                        }        
                        ?>                    
                    </div>
                </td>
            </tr>              
            <?php
    }
    ?>
    </tbody>
    
    <tr>
        <td colspan="8" style="text-align: right;">
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
