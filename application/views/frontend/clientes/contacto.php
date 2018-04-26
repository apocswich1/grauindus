<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>clientes/index/<?php echo $pagina?>">Clientes &gt;&gt;</a></li>
      <li>Contactos de Cliente  <?php echo $cliente->razon_social?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Contactos de Cliente  <?php echo $cliente->razon_social?></h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>clientes/contacto_add/<?php echo $id?>/<?php echo $pagina?>">Agregar Contacto</a>
    <br /><br />
	
</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			<th>Nombre</th>
			<th>Teléfono</th>
			<th>E-Mail</th>
            <th>Función</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
            <td><?php echo $dato->nombre?></td>
            <td><?php echo $dato->telefono?></td>
		    <td><a href="<?php echo base_url();?>clientes/mensaje_contacto/<?php echo $dato->id?>" class="fancybox fancybox.ajax"><?php echo $dato->correo?></a></td>
           <td><?php echo $dato->funcion?></td> 
			<td>
               <a href="<?php echo base_url()?>clientes/contacto_edit/<?php echo $dato->id?>/<?php echo $id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>clientes/contacto_delete/<?php echo $dato->id?>/<?php echo $id?>/<?php echo $pagina?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
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
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>