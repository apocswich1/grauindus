<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>piezas_adicionales/">Piezas Adicionales &gt;&gt;</a></li>
      <li>Resultados para el término <strong><?php echo $buscar?></strong></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para el término <strong><?php echo $buscar?></strong></h3></div>

	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."piezas_adicionales/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
	    <th>Piezas Adicionales</th>
            <th>Unidad de Venta</th>
            <th>Unidad de Compra</th>
	    <th>Valor Venta</th>
            <th>Unidad de Conversión</th>
            <th>Cálculo Ingeniería</th>
	    <th>Valor Compra</th>            
            <th>Fecha</th>
	    <th>Usuario</th>             
	    <th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    $unidad_venta=$this->unidades_de_uso_model->getUnidadesDeUsoPorId($dato->unidad_de_venta);
    $unidad_compra=$this->unidades_de_uso_model->getUnidadesDeUsoPorId($dato->unidad_de_compra); 
    $user=$this->usuarios_model->getUsuariosPorId($dato->id_user); 
    
    if ($user->nombre!='')
    {
        $nombre=$user->nombre;
    }
    else $nombre='No registrado';
    
    ?>
        <td><?php echo $dato->piezas_adicionales?></td>
        <td><?php echo $unidad_venta->unidades_de_compra;?></td>
        <td><?php echo $unidad_compra->unidades_de_compra?></td>
	<td><?php echo $dato->valor_venta?></td>        
        <td><?php echo $dato->unidad_de_conversion?></td>
        <td><?php echo $dato->calculo_ingenieria?></td>
	<td><?php echo $dato->valor_compra?></td>        
        <td><?php echo $dato->fecha_modificacion?></td>
	<td><?php echo $nombre ?></td>                
			<td>
               <a href="<?php echo base_url()?>piezas_adicionales/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>piezas_adicionales/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
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