<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <li>Procesos Especiales</li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Procesos Especiales</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>procesos_especiales/add">Agregar Procesos Especiales</a>
    <br /><br />

</div>

<table class="table table-bordered table-striped indice">
	<thead>
	<tr>
              <th>Proceso</th>
              <th>Proveedor</th>
              <th>Ancho</th>
              <th>Largo</th>
              <th>Tipo</th>
              <th>Precio</th>
              <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
                <th>Acciones</th>
                <?php
              }
              ?>
	</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
//        $p1=$this->proveedores_model->getProveedoresPorId($dato->proveedor_1);
//        $p2=$this->proveedores_model->getProveedoresPorId($dato->proveedor_2);
    ?>
            <td><?php echo $dato->nombre_procesp;?></td>
            <td><?php echo $dato->proveedor;?></td>
            <td><?php echo $dato->ancho;?></td>
            <td><?php echo $dato->largo;?></td>
            <td><?php if ($dato->tipo=1) echo "Oro"; elseif($dato->tipo=2) echo "Plata"; else  echo "Cobre";?></td>
            <td><?php echo $dato->precio;?></td>
            <?php
              if($this->session->userdata('perfil')==1)
              {
                ?>
                <td>
               <a href="<?php echo base_url()?>procesos_especiales/edit/<?php echo $dato->id_procesp?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>procesos_especiales/delete/<?php echo $dato->id_procesp?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
                <?php
              }
              ?>
			
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="7" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>


<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>
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
            
     
        <!--</tbody>
</table>
<script type="text/javascript">

CargarDataMolde();

</script>    -->
