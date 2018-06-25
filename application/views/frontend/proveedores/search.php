<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>proveedores/index">Proveedores &gt;&gt;</a></li>
      <li>Resultados para : <?php echo $buscar?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Resultados para : <?php echo $buscar?> ( <?php echo $cuantos?> en total)</h3></div>
<div>
    <br /><br />
	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."proveedores/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->
</div>  
<table class="table table-bordered table-striped indice">
	<thead>
	<tr>
		
	      <th>Proveedor</th>
	      <th>Teléfono</th>
              <th>E-Mail</th>
              <th>Rubro 1</th>
              <th>Rubro 2</th>
              <th>Contacto</th>
              <th>Rut</th>
	      <th>Acciones</th>
        </tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
       // debug_backtrace();
    ?><tr>
        <td><?php echo $dato->nombre;?></td>
	    <td><?php echo $dato->telefono;?></td>
            <td><?php echo $dato->correo;?></td>
            <td><?php echo $dato->rubro;?></td>
            <td><?php echo $dato->rubro2;?></td>
            <td><?php echo $dato->contacto;?></td>
            <td><?php echo $dato->rut;?></td>
			<td>
               <a href="<?php echo base_url()?>proveedores/edit/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>proveedores/delete/<?php echo $dato->id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td> </tr> 
    
    <?php
    }
    ?></tbody>
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

