<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Servicios Internos y Externos</h3></div>



<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>servicios/add">Agregar</a>
    <br /><br />
	<?php //echo $this->layout->element('admin_buscador'); ?>
</div>

<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
			<th>Servicio</th>
			<th>Tipo</th>
            <th>Precio</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
    ?>
        <td><?php echo $dato->servicio?></td>
            <td><?php echo $dato->tipo?></td>
            <td>$<?php echo number_format($dato->precio,0,"",".")?></td>
         
			<td>
               <a href="<?php echo base_url()?>servicios/edit/<?php echo $dato->id?>" title="Editar"><i class="icon-pencil"></i></a>	
           		<a href="javascript:void(0);" onclick="eliminar('<?php echo base_url()?>servicios/delete/<?php echo $dato->id?>');" title="Eliminar"><i class="icon-trash"></i></a>	
            </td>
    </tbody>
    <?php
    }
    ?>
</table>
<?php //echo $this->layout->element('admin_paginador'); ?>
